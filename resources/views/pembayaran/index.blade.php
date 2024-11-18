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
                            <th scope="col">Nomor</th>
                            <th scope="col">Nama Pendaftar</th>
                            <th scope="col">Daftar Pada Seller</th>
                            <th scope="col">Hewan Qurban</th>
                            <th scope="col">Harga</th>
                            <th scope="col">No Hp</th>
                            <th scope="col">Alamat</th>
                            <th scope="col">Masjid</th>
                            <th scope="col">Pembayaran</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($data as $row)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $row->user_name = ucwords($row->user_name) }}</td>
                                <td>{{ $row->seller_name = ucwords($row->seller_name) }}</td>
                                <td>{{ $row->seller_tipe_hewan }}</td>
                                <td>Rp. {{ number_format($row->seller_harga) }}</td>
                                <td>
                                    @php
                                        $noHp = $row->no_hp;
                                        $kodeNoHp = '+62' . substr($noHp, 1);
                                    @endphp
                                    <a class="btn btn-xs btn-success" href="https://wa.me/{{ urlencode($kodeNoHp) }}?text=Halo%20{{ $row->user_name }}%0AAnda%20sudah%20memesan%20Qurban%20{{ $row->seller_tipe_hewan }}%20pada%20aplikasi%20Qurban%20yang%20terdaftar%20di%20{{ $row->masjid }}" target="_blank">{{ $row->no_hp }}</a>
                                </td>
                                <td>{{ $row->alamat = ucwords($row->alamat) }}</td>
                                <td>{{ $row->masjid = ucwords($row->masjid) }}</td>
                                <td>
                                    @if($row->status_pembayaran == "sukses")
                                        <span class="badge badge-success">Sudah Dibayar</span>
                                    @else
                                        <span class="badge badge-warning"> Belum Bayar</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div id="map" class="mb-3" style="height: 300px;"></div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var map = L.map('map').setView([-3.658634150357333, 128.18187814633413], 13); // Default view

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
        }).addTo(map);

        @foreach ($data as $row)
            @if ($row->latitude && $row->longitude)
                L.marker([{{ $row->latitude }}, {{ $row->longitude }}]).addTo(map)
                    .bindPopup('<strong>{{ $row->user_name }}</strong><br>{{ $row->alamat}}<br><a href="https://www.google.com/maps?q={{$row->latitude}}, {{$row->longitude}}" target="_blank" class="text">Lokasi</a>');
            @endif
        @endforeach
    });
</script>
@endsection