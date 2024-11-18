@extends('layouts.admin')
@section('content')
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{ $title }}</h3>
                    @if(Auth::user()->role !== "admin")
                    <a href="{{ route('seller.create') }}" class="btn btn-dark btn-sm" style="float: right;"><i class="fas fa-plus">Tambah</i></a>
                    @endif
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
                                <th>No</th>
                                <th>Nama</th>
                                <th>Tipe Hewan</th>
                                <th>Umur Qurban</th>
                                <th>Harga Qurban</th>
                                <th>Harga Per Orang</th>
                                <th>Alamat</th>
                                <th>Nomor Hp</th>
                                <th>Quota</th>
                                <th>Terdaftar</th>
                                @if(Auth::user()->role !== "admin")
                                <th>Aksi</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($data as $row)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $row->name = ucwords($row->name) }}</td>
                                <td>{{ $row->tipe_hewan }}</td>
                                <td>{{ $row->umur_qurban }}</td>
                                <td>Rp {{ number_format($row->harga) }}</td>
                                <td>RP {{ number_format($row->harga_per_orang) }}</td>
                                <td>{{ $row->alamat = ucwords($row->alamat) }}</td>
                                <td>
                                    @php
                                        $noHp = $row->no_hp;
                                        $kodeNoHp = '+62' . substr($noHp, 1);
                                    @endphp
                                    <a class="btn btn-xs btn-success" href="https://wa.me/{{ urlencode($kodeNoHp) }}?text=Halo%20{{ $row->name }}" target="_blank">{{ $row->no_hp }}</a>
                                </td>
                                <td>{{ $row->quota }}</td>
                                <td>{{ $row->registered }}</td>
                                @if(Auth::user()->role !== "admin")
                                <td>
                                    <a href="{{ route('seller.edit', $row->id_seller) }}" class="btn btn-xs btn-warning"><i class="fas fa-edit"> Edit</i></a>
                                    <form action="{{ route('seller.destroy', $row->id_seller) }}" method="POST" style="display: inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-xs btn-flat show_confirm"><i class="fas fa-trash"> Hapus</i></button>
                                    </form>
                                </td>
                                @endif
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @if(Auth::user()->role == "admin")
                    <div id="map" class="mb-3" style="height: 300px;"></div>
                    @endif
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
                    .bindPopup('<strong>{{ $row->name }}</strong><br>{{ $row->alamat }}<br><a href="https://www.google.com/maps?q={{$row->latitude}}, {{$row->longitude}}" target="_blank" class="text">Lokasi</a>');
            @endif
        @endforeach
    });
</script>
@endsection
