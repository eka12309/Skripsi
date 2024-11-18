<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Group;
use App\Models\Transaksi;
use App\Models\User;
use App\Models\Qurban;
use App\Models\Seller;
use App\Models\Setting;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(Auth::check() && Auth::user()->role == "user"){
            return redirect()->route('landing.home');
        }
        $userId = Auth::user()->id_user;

        $seller = Seller::where('id_user', $userId)->first();

        if ($seller) {
            $pendaftar = Qurban::join('users', 'users.id_user', '=', 'daftar_qurban.id_user')
                ->join('seller', 'seller.id_seller', '=', 'daftar_qurban.id_seller')
                ->join('users as seller_user', 'seller_user.id_user', '=', 'seller.id_user')
                ->where('daftar_qurban.id_seller', $seller->id_seller)
                ->count();
        } else {
            $pendaftar = 0;
        }

        $penjualQurban = Seller::join('users', 'users.id_user', '=', 'seller.id_user')
        ->where('seller.id_user', $userId)
        ->count();

        $title = 'Home';
        $setting = Setting::first();

        $group = Group::count();
        $transaksi = Transaksi::count();
        $qurban = Qurban::count();
        $seller = Seller::count();
        $user = User::count();

        return view('dashboard.index', compact('title','setting', 'group', 'transaksi', 'qurban', 'seller', 'user', 'pendaftar', 'penjualQurban'));
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
