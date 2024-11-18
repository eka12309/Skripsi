<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Masjid;

class MasjidController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = "Masjid";
        $data = Masjid::get();

        return view('masjid.index', compact('title', 'data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = "Tambah Masjid";
        $data = Masjid::get();

        return view('masjid.create', compact('title', 'data'));
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
            'nama_masjid' => 'required',
        ], $message);

        $data = new Masjid();
        $data->nama_masjid = $request->nama_masjid;
        $data->latitude = $request->latitude;
        $data->longitude = $request->longitude;
        $data->save();

        return redirect()->route('masjid.index')->with('sukes', 'Berhasil Menambah Masjid');
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
