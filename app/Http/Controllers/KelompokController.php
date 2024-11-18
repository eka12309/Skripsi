<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Group;
use App\Models\Qurban;
use App\Models\Seller;
use Illuminate\Support\Facades\Auth;

class KelompokController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(Auth::check() && Auth::user()->role == "user"){
            return redirect()->route('landing.home');
        }

        $title = "Pengelompokan";
        $data = Group::get();

        return view('pengelompokan.index', compact('title', 'data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if(Auth::check() && Auth::user()->role == "user"){
            return redirect()->route('landing.home');
        }

        $title = "Kelompokan Pendaftar";
        $pendaftar = Qurban::join('users', 'users.id_user', '=', 'daftar_qurban.id_user')->where('daftar_qurban.status_pembayaran', "=", "sukses")->get();
        $seller = Seller::join('users', 'users.id_user', '=', 'seller.id_user')->get();

        return view('pengelompokan.create', compact('title', 'pendaftar', 'seller'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $message = [
            'required' => ':attribute wajib diisi!!!',
        ];
    
        $request->validate([
            'tipe_hewan' => 'required',
            'penjual' => 'required',
            'pendaftar' => 'required|array',
        ], $message);
    
        $group = new Group();
        $group->tipe_hewan = $request->tipe_hewan;
        $group->penjual = $request->penjual;
        
        $group->pendaftar = json_encode($request->pendaftar);
        $group->save();
            
        return redirect()->route('kelompok.index')->with('success', 'Pendaftar berhasil dikelompokkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $group = Group::findOrFail($id);
        $title = "Edit Kelompok";
        $pendaftarArray = json_decode($group->pendaftar, true); // Decode JSON menjadi array
        $pendaftar = Qurban::join('users', 'users.id_user', '=', 'daftar_qurban.id_user')->get();
        $seller = Seller::join('users', 'users.id_user', '=', 'seller.id_user')->get();

        return view('pengelompokan.edit', compact('title', 'group', 'pendaftar', 'seller', 'pendaftarArray'));
    }




    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $group = Group::findOrFail($id);

        // Validasi input
        $validated = $request->validate([
            'tipe_hewan' => 'required|string',
            'penjual' => 'required|string',
            'pendaftar' => 'required|array',
        ]);

        // Encode pendaftar menjadi JSON
        $validated['pendaftar'] = json_encode($validated['pendaftar']);

        // Update group dengan data yang telah divalidasi
        $group->update($validated);

        return redirect()->route('kelompok.index')->with('sukses', 'Kelompok berhasil diperbarui.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = Group::findOrFail($id);
        $data->delete();

        return back()->with('sukses', 'Kelompok berhasil dihapus.');
    }
}
