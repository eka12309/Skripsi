<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Qurban;
use App\Models\Seller;
use App\Models\Masjid;
use Midtrans\Config;
use Midtrans\Snap;

class QurbanLandingController extends Controller
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
        $qurban = Seller::join('users', 'users.id_user', '=', 'seller.id_user')->get();
        $masjid = Masjid::get();

        return view('landing.qurban', compact('qurban', 'masjid'));
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
        $message = [
            'required' => ':attribute wajib diisi!!!',
        ];

        $request->validate([
            'id_seller' => 'required',
            'tipe_qurban' => 'required',
            'no_hp' => 'required',
            'alamat' => 'required',
            'masjid' => 'required',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
        ], $message);

        $userId = Auth()->id('id_user');

        $seller = Seller::find($request->id_seller);

        if (!$seller) {
            return back()->with('error', 'Qurban tidak ditemukan.');
        }

        if ($seller->quota == 0) {
            return back()->with('error', 'Kuota untuk Qurban ini sudah penuh.');
        }

        if (Qurban::where('id_user', $userId)->where('id_seller', $request->id_seller)->exists()) {
            return back()->with('error', 'Anda sudah mendaftar untuk Qurban ini.');
        }

        $hargaItem = round($seller->harga_per_orang);

        $transaction_details = [
            'order_id' => uniqid(),
            'gross_amount' => $hargaItem,
        ];

        $item_details = [
            [
                'id' => $seller->id_daftar_qurban,
                'price' => $hargaItem,
                'quantity' => 1,
                'name' => $seller->tipe_hewan,
            ],
        ];

        $customer_details = [
            'first_name' => Auth::user()->name,
            'email' => Auth::user()->email,
        ];

        $transaction = [
            'transaction_details' => $transaction_details,
            'item_details' => $item_details,
            'customer_details' => $customer_details,
        ];

        $snapToken = Snap::getSnapToken($transaction);

        $qurban = new Qurban();
        $qurban->id_user = Auth()->id('id_user');
        $qurban->id_seller = $request->id_seller;
        $qurban->snap_token = $snapToken;
        $qurban->status_pembayaran = "pending";
        $qurban->tipe_qurban = $request->tipe_qurban;
        $qurban->no_hp = $request->no_hp;
        $qurban->alamat = $request->alamat;
        $qurban->masjid = $request->masjid;
        $qurban->latitude = $request->latitude;
        $qurban->longitude = $request->longitude;
        $qurban->save();

        $seller->increment('registered');
        $seller->decrement('quota');

        return redirect()->route('landing.pembayaran')->with('sukses', 'Berhasil Mendaftar Qurban');
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
