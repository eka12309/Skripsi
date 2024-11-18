<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Seller;
use App\Models\User;

class SellerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(Auth::check() && Auth::user()->role == "user"){
            return redirect()->route('landing.home');
        }
        
        if(Auth::user()->role == 'admin'){
            $title = "Data Penjualan";
            $data = Seller::join('users', 'users.id_user', '=', 'seller.id_user')
            ->get();

            return view('seller.index', compact('title', 'data'));
        }
        $userId = Auth::user()->id_user;
        $user = User::find($userId);

        $latitudeUser = $user->latitude;
        $longitudeUser = $user->longitude;

        $title = "Data Penjualan";
        $data = Seller::join('users', 'users.id_user', '=', 'seller.id_user')
        ->where('seller.id_user', $userId)
        ->get();

        return view('seller.index', compact('title', 'data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if(Auth::check() && Auth::user()->role == "user"){
            return redirect()->route('landing.home');
        }

        $title = "Tambah Data Penjualan";

        return view('seller.create', compact('title'));
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
            'umur_qurban' => 'required',
            'alamat' => 'required',
            'no_hp' => 'required',
            'harga' => 'required',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        ], $message);

        if($request->tipe_hewan == 'Sapi'){
            $seller = new Seller();
            $seller->id_user = Auth()->id('id_user');
            $seller->tipe_hewan = $request->tipe_hewan;
            $seller->umur_qurban = $request->umur_qurban;
            $seller->alamat = $request->alamat;
            $seller->no_hp = $request->no_hp;
            $seller->harga = $request->harga;
            $seller->harga_per_orang = $request->harga / 7;
            $seller->quota = 7;
            $seller->latitude = $request->latitude;
            $seller->longitude = $request->longitude;
            $seller->save();
            
            return redirect()->route('seller.index')->with('sukses', 'Berhasil Tambah Data Penjualan');
        }


        if($request->tipe_hewan == 'Kambing'){
            $seller = new Seller();
            $seller->id_user = Auth()->id('id_user');
            $seller->tipe_hewan = $request->tipe_hewan;
            $seller->umur_qurban = $request->umur_qurban;
            $seller->alamat = $request->alamat;
            $seller->no_hp = $request->no_hp;
            $seller->harga = $request->harga;
            $seller->harga_per_orang = $request->harga;
            $seller->quota = 1;
            $seller->latitude = $request->latitude;
            $seller->longitude = $request->longitude;
            $seller->save();
            
            return redirect()->route('seller.index')->with('sukses', 'Berhasil Tambah Data Penjualan');
        }

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
        if(Auth::check() && Auth::user()->role == "user"){
            return redirect()->route('landing.home');
        }
        
        $title = "Data Penjualan";
        $seller = Seller::findorfail($id);
        
        return view('seller.edit', compact('seller', 'title'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $seller = Seller::findOrFail($id);
        
        
        $newTipeHewan = $request->tipe_hewan;

        if ($newTipeHewan == 'Sapi') {
            $harga_per_orang = $request->harga / 7;

            $update = [
                'id_user' => auth()->id(),
                'tipe_hewan' => $newTipeHewan,
                'umur_qurban' => $request->umur_qurban,
                'alamat' => $request->alamat,
                'no_hp' => $request->no_hp,
                'harga' => $request->harga,
                'harga_per_orang' => $harga_per_orang,
                'quota' => 7,
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
            ];

            $seller->update($update);

            return redirect()->route('seller.index')->with('sukses', 'Berhasil Edit Data');
        } 

        if ($newTipeHewan == 'Kambing') {
            $harga_per_orang = $request->harga;

            $update = [
                'id_user' => auth()->id(),
                'tipe_hewan' => $newTipeHewan,
                'umur_qurban' => $request->umur_qurban,
                'alamat' => $request->alamat,
                'no_hp' => $request->no_hp,
                'harga' => $request->harga,
                'harga_per_orang' => $harga_per_orang,
                'quota' => 1,
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
            ];

            $seller->update($update);

            return redirect()->route('seller.index')->with('sukses', 'Berhasil Edit Data');
        } 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $seller = Seller::find($id);
        
        $seller->delete();
        return back()->with('sukses', 'Data Berhasil Dihapus');
    }
}
