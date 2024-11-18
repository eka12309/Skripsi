@extends('layouts.admin')
@section('content')
    <?php
    $konf = DB::table('settings')->first();
    ?>
    <?php
    $title = 'Home';
    ?>
    <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
            <div class="row">
                @if(Auth::user()->role == "admin")
                <div class="col-lg-4 col-sm-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{$user}}</h3>
                            <p>Pengguna</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-user"></i>
                        </div>
                        <a href="{{route('pengguna.index')}}" class="small-box-footer">More info <i
                                class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <!-- small box -->
                    <div class="small-box" style="background-color: #FF885B;">
                        <div class="inner">
                            <h3>{{$qurban}}</h3>
                            <p>Pendaftar Qurban</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-user-plus"></i>
                        </div>
                        <a href="{{route('pembayaran.index')}}" class="small-box-footer">More info <i
                                class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <!-- small box -->
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3>{{$seller}}</h3>
                            <p>Data Penjual</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-shopping-cart"></i>
                        </div>
                        <a href="{{route('seller.index')}}" class="small-box-footer">More info <i
                                class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <!-- small box -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>{{$transaksi}}</h3>
                            <p>Transaksi</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-money-bill"></i>
                        </div>
                        <a href="{{route('transaksi.index')}}" class="small-box-footer">More info <i
                                class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <!-- small box -->
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>{{$group}}</h3>
                            <p>Pengelompokan Pendaftar</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <a href="{{route('kelompok.index')}}" class="small-box-footer">More info <i
                                class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                @endif
                @if(Auth::user()->role == "seller")
                <div class="col-lg-6 col-sm-6">
                    <!-- small box -->
                    <div class="small-box text-light" style="background-color: #C7253E;">
                        <div class="inner">
                            <h3>{{$pendaftar}}</h3>
                            <p>Pendaftar Qurban</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-user"></i>
                        </div>
                        <a href="{{route('pembayaran.index')}}" class="small-box-footer">More info <i
                                class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-6 col-sm-6">
                    <!-- small box -->
                    <div class="small-box text-light bg-success">
                        <div class="inner">
                            <h3>{{$penjualQurban}}</h3>
                            <p>Qurban</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-shopping-cart"></i>
                        </div>
                        <a href="{{route('seller.index')}}" class="small-box-footer">More info <i
                                class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                @endif
            </div>
    </div>
@endsection
