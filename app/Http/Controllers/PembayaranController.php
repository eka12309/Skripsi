<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Qurban;
use App\Models\Pembayaran;
use App\Models\Transaksi;
use App\Models\Seller;
use Midtrans\Config;
use Midtrans\Snap;


class PembayaranController extends Controller
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
        if(Auth::check() && Auth::user()->role == "user"){
            return redirect()->route('landing.home');
        }

        if(Auth::user()->role == "admin"){
            $title = "Data Pendaftar";
            $data = Qurban::join('users', 'users.id_user', '=', 'daftar_qurban.id_user')
            ->join('seller', 'seller.id_seller', '=', 'daftar_qurban.id_seller')
            ->join('users as seller_user', 'seller_user.id_user', '=', 'seller.id_user')
            ->select('daftar_qurban.*', 'users.name as user_name', 'seller_user.name as seller_name', 'seller.tipe_hewan as seller_tipe_hewan', 'seller.harga_per_orang as seller_harga' )
            ->get();

            return view('pembayaran.index', compact('title', 'data'));
        }

        $userId = Auth::user()->id_user;

        $seller = Seller::where('id_user', $userId)->first();
        if (!$seller) {
            return redirect()->route('landing.home')->with('error', 'Seller tidak ditemukan.');
        }

        $title = "Data Pendaftar";
        $data = Qurban::join('users', 'users.id_user', '=', 'daftar_qurban.id_user')
            ->join('seller', 'seller.id_seller', '=', 'daftar_qurban.id_seller')
            ->join('users as seller_user', 'seller_user.id_user', '=', 'seller.id_user')
            ->where('daftar_qurban.id_seller', $seller->id_seller) // Filter berdasarkan id_seller
            ->select('daftar_qurban.*', 'users.name as user_name', 'seller_user.name as seller_name', 'seller.tipe_hewan as seller_tipe_hewan', 'seller.harga_per_orang as seller_harga')
            ->get();

        return view('pembayaran.index', compact('title', 'data'));
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
            return redirect()->route('pembayaran.index')->with('sukses', 'Pembayaran tidak ditemukan');
        }

        if ($pembayaran->tipe_hewan == 'sapi') {

            $harga_per_orang = $pembayaran->harga / 7;

            $transaksi = new Transaksi();
            $transaksi->id_user = Auth()->id('id_user');
            $transaksi->id_seller = $pembayaran->id_seller;
            $transaksi->id_daftar_qurban = $pembayaran->id_daftar_qurban;
            $transaksi->invoice_number = 'INV-' . strtoupper(uniqid());
            $transaksi->harga = $harga_per_orang;
            $transaksi->status = 'pending';
            $transaksi->save();

            return view('pembayaran.show', compact('pembayaran', 'transaksi'));
        } else {
            $transaksi = new Transaksi();
            $transaksi->id_user = Auth()->id('id_user');
            $transaksi->id_seller = $pembayaran->id_seller;
            $transaksi->id_daftar_qurban = $pembayaran->id_daftar_qurban;
            $transaksi->invoice_number = 'INV-' . strtoupper(uniqid());
            $transaksi->harga = $pembayaran->harga;
            $transaksi->status = 'pending';
            $transaksi->save();

            return view('pembayaran.show', compact('pembayaran', 'transaksi'));
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

        
        return view('pembayaran.sukses');
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

        return view('pembayaran.pending');
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

        return view('pembayaran.gagal');
    }




    // public function pembayaran(Request $request, $id)
    // {
    //     // Ambil data qurban berdasarkan ID
    //     $qurban = Qurban::findOrFail($id);

    //     // Buat transaksi
    //     $transaction_details = [
    //         'order_id' => uniqid(),
    //         'gross_amount' => $qurban->harga,
    //     ];

    //     $item_details = [
    //         [
    //             'id' => $qurban->id_daftar_qurban,
    //             'price' => $qurban->harga,
    //             'quantity' => 1,
    //             'name' => $qurban->tipe_hewan,
    //         ],
    //     ];

    //     $customer_details = [
    //         'first_name' => Auth::user()->name,
    //         'email' => Auth::user()->email,
    //     ];

    //     $transaction = [
    //         'transaction_details' => $transaction_details,
    //         'item_details' => $item_details,
    //         'customer_details' => $customer_details,
    //     ];

    //     // Ambil token pembayaran dari Midtrans
    //     $snapToken = Snap::getSnapToken($transaction);

    //     // Kirimkan token sebagai respons JSON
    //     return response()->json(['token' => $snapToken]);
    // }


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
