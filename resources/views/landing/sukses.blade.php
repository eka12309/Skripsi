@extends('layouts.web')
@section('content')
    <!--courses section start -->
    <div class="courses_section layout_padding">
        <div class="container">
            <div class="card">
                <div class="card-head mt-5">
                    <h1 class="courses_taital text-success">Pembayaran Berhasil</h1>
                </div>
                <div class="card-body text-center d-flex flex-column justify-content-center align-items-center">
                    <h1 class="text-success">Terima kasih telah melakukan pembayaran. Pengurus Qurban Akan Segera Menghubungi Anda</h1>
                    <a href="{{ route('landing.transaksi') }}" class="btn btn-primary mt-3">Lihat Transaksi</a>
                </div>
            </div>
        </div>
    </div>
    <!--courses section end -->
@endsection