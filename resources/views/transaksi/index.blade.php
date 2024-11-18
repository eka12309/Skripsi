@extends('layouts.admin')
@section('content')
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{ $title }}</h3>
                </div>
                <div class="card-body table table-responsive">
                    @if ($message = Session::get('sukses'))
                    <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        {{ $message }}
                    </div>
                    @endif
                    <table class="table table-bordered" id="example1">
                        <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Nomor Invoice</th>
                            <th scope="col">Pendaftar</th>
                            <th scope="col">Hewan Qurban</th>
                            <th scope="col">Jumlah</th>
                            <th scope="col">Alamat</th>
                            <th scope="col">Masjid</th>
                            <th scope="col">Status</th>
                            <th scope="col">Tanggal</th>
                            <th scope="col">#</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($data as $pembayaran)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $pembayaran->invoice_number }}</td>
                                <td>{{ $pembayaran->user_name = ucwords($pembayaran->user_name) }}</td>
                                <td>{{ $pembayaran->seller_tipe_hewan }}</td>
                                <td>Rp {{ number_format($pembayaran->transaksi_harga) }}</td>
                                <td>{{ $pembayaran->alamat_ts = ucwords($pembayaran->alamat_ts) }}</td>
                                <td>{{ $pembayaran->masjid_ts = ucwords($pembayaran->masjid_ts) }}</td>
                                <td><span class="badge badge-success">{{ $pembayaran->status }}</span></td>
                                <td>{{ \Carbon\Carbon::parse($pembayaran->tanggal)->format('d F Y H:i') }}</td>
                                <td><a href="{{ route('transaksi.show', $pembayaran->id_transaksi) }}" class="btn btn-sm btn-primary" target="_blank">Invoice</a></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
@endsection