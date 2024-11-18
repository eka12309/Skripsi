@extends('layouts.web')
@section('content')
    <!--courses section start -->
    <div class="courses_section layout_padding">
        <div class="container">
            <div class="card">
                <div class="card-head mt-5">
                    <h1 class="courses_taital">Data Pembayaran</h1>
                </div>
                <div class="card-body table table-responsive">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th scope="col">Nomor</th>
                            <th scope="col">Pendaftar</th>
                            <th scope="col">Daftar Pada Seller</th>
                            <th scope="col">Hewan Qurban</th>
                            <th scope="col">Alamat</th>
                            <th scope="col">Masjid</th>
                            <th scope="col">Jumlah</th>
                            <th scope="col">Status</th>
                            <th scope="col">Tanggal</th>
                            <th scope="col">#</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($transaksi as $row)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $row->user_name }}</td>
                                <td>{{ $row->seller_name }}</td>
                                <td>{{ $row->seller_tipe_hewan }}</td>
                                <td>{{ $row->alamat_ts }}</td>
                                <td>{{ $row->masjid_ts }}</td>
                                <td>Rp {{ number_format($row->transaksi_harga) }}</td>
                                <td><span class="badge badge-success">{{ $row->status }}</span></td>
                                <td>{{ \Carbon\Carbon::parse($row->tanggal)->format('d F Y H:i') }}</td>
                                <td><a href="{{ route('transaksi.show', $row->id_transaksi) }}" class="btn btn-sm btn-primary" target="_blank">Invoice</a></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!--courses section end -->
@endsection