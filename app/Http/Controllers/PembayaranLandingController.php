<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Qurban;
use App\Models\Pembayaran;
use App\Models\Transaksi;
use Midtrans\Config;
use Midtrans\Snap;

class PembayaranLandingController extends Controller
{
    public function __construct()
    {
        Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        Config::$isProduction = env('MIDTRANS_IS_PRODUCTION');
        Config::$isSanitized = true;
        Config::$is3ds = true;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        if(Auth::user()->role == "admin"){
            $title = "Data Pendaftar";
            $data = Qurban::join('users', 'users.id_user', '=', 'daftar_qurban.id_user')
            ->join('seller', 'seller.id_seller', '=', 'daftar_qurban.id_seller')
            ->join('users as seller_user', 'seller_user.id_user', '=', 'seller.id_user')
            ->select('daftar_qurban.*', 'users.name as user_name', 'seller_user.name as seller_name', 'seller.tipe_hewan as seller_tipe_hewan', 'seller.harga_per_orang as seller_harga' )
            ->get();

            return view('landing.pembayaran', compact('title', 'data'));
        }

        $userId = Auth::user()->id_user;

        $title = "Data Pendaftar";
        $data = Qurban::join('users', 'users.id_user', '=', 'daftar_qurban.id_user')
        ->join('seller', 'seller.id_seller', '=', 'daftar_qurban.id_seller')
        ->join('users as seller_user', 'seller_user.id_user', '=', 'seller.id_user')
        ->where('daftar_qurban.id_user', $userId)
        ->select('daftar_qurban.*', 'users.name as user_name', 'seller_user.name as seller_name', 'seller.tipe_hewan as seller_tipe_hewan', 'seller.harga_per_orang as seller_harga')
        ->get();

        return view('landing.pembayaran', compact('title', 'data'));
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
    public function show($id)
    {
        $pembayaran = Qurban::join('users', 'users.id_user', '=', 'daftar_qurban.id_user')
        ->join('seller', 'seller.id_seller', '=', 'daftar_qurban.id_seller')
        ->where('id_daftar_qurban', $id)
        ->first();

        if (!$pembayaran) {
            return redirect()->route('landing.pembayaran')->with('sukses', 'Pembayaran tidak ditemukan');
        }

        if ($pembayaran->tipe_hewan == 'Sapi') {

            $harga_per_orang = $pembayaran->harga / 7;

            $transaksi = new Transaksi();
            $transaksi->id_user = Auth()->id('id_user');
            $transaksi->id_seller = $pembayaran->id_seller;
            $transaksi->id_daftar_qurban = $pembayaran->id_daftar_qurban;
            $transaksi->invoice_number = 'INV-' . strtoupper(uniqid());
            $transaksi->harga = $harga_per_orang;
            $transaksi->alamat_ts = $pembayaran->alamat;
            $transaksi->masjid_ts = $pembayaran->masjid;
            $transaksi->status = 'pending';
            $transaksi->save();

            return view('landing.show', compact('pembayaran', 'transaksi'));
        } else {
            $transaksi = new Transaksi();
            $transaksi->id_user = Auth()->id('id_user');
            $transaksi->id_seller = $pembayaran->id_seller;
            $transaksi->id_daftar_qurban = $pembayaran->id_daftar_qurban;
            $transaksi->invoice_number = 'INV-' . strtoupper(uniqid());
            $transaksi->harga = $pembayaran->harga;
            $transaksi->alamat_ts = $pembayaran->alamat;
            $transaksi->masjid_ts = $pembayaran->masjid;
            $transaksi->status = 'pending';
            $transaksi->save();

            return view('landing.show', compact('pembayaran', 'transaksi'));
        }
    }

    public function sukses(Request $request, $id_transaksi)
    {
        $transaksi = Transaksi::find($id_transaksi);

        if ($transaksi) {
            
            $transaksi->status = 'sukses';
            $transaksi->save();

            $daftar_qurban = Qurban::find($transaksi->id_daftar_qurban);

            if ($daftar_qurban) {
                
                $daftar_qurban->status_pembayaran = 'sukses'; 
                $daftar_qurban->save();
            }
        }

        
        return view('landing.sukses');
    }

    public function pending(Request $request, $id_transaksi)
    {
        $transaksi = Transaksi::find($id_transaksi);

        if ($transaksi) {
            
            $transaksi->status = 'pending';
            $transaksi->save();

            
            $daftar_qurban = Qurban::find($transaksi->id_daftar_qurban);

            if ($daftar_qurban) {
                
                $daftar_qurban->status_pembayaran = 'pending';
                $daftar_qurban->save();
            }
        }

        return view('landing.pending');
    }


    public function gagal(Request $request, $id_transaksi)
    {
        $transaksi = Transaksi::find($id_transaksi);

        if ($transaksi) {
            
            $transaksi->status = 'gagal';
            $transaksi->save();

            $daftar_qurban = Qurban::find($transaksi->id_daftar_qurban);

            if ($daftar_qurban) {
                $daftar_qurban->status_pembayaran = 'gagal';
                $daftar_qurban->save();
            }
        }

        return view('landing.gagal');
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
