<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Transaksi;

class TransaksiLandingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(Auth::user()->role == "admin"){
            $title = "Data Transaksi";
            $transaksi = Transaksi::join('users as pendaftar', 'pendaftar.id_user', '=', 'transaksi.id_user')
            ->join('seller', 'seller.id_seller', '=', 'transaksi.id_seller')
            ->join('users as seller_user', 'seller_user.id_user', '=', 'seller.id_user')
            ->select('transaksi.*', 
            'pendaftar.name as user_name', 
            'seller_user.name as seller_name', 
            'transaksi.created_at as tanggal', 
            'seller.tipe_hewan as seller_tipe_hewan', 
            'transaksi.harga as transaksi_harga')
            ->get();
            return view('landing.transaksi', compact('transaksi', 'title'));
        }

        $userId = Auth::user()->id_user;
        
        $title = "Data Transaksi";
        $transaksi = Transaksi::join('users as pendaftar', 'pendaftar.id_user', '=', 'transaksi.id_user')
        ->join('seller', 'seller.id_seller', '=', 'transaksi.id_seller')
        ->join('users as seller_user', 'seller_user.id_user', '=', 'seller.id_user')
        ->where('transaksi.id_user', $userId)
        ->select('transaksi.*', 
        'pendaftar.name as user_name', 
        'seller_user.name as seller_name', 
        'transaksi.created_at as tanggal', 
        'seller.tipe_hewan as seller_tipe_hewan', 
        'transaksi.harga as transaksi_harga')
        ->get();
        return view('landing.transaksi', compact('transaksi', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
