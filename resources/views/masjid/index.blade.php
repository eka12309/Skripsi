@extends('layouts.admin')
@section('content')
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{ $title }}</h3>
                    <a href="{{ route('masjid.create') }}" class="btn btn-dark btn-sm" style="float: right;"><i class="fas fa-plus">Tambah</i></a>
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
                                <th>Nama Masjid</th>
                                <th>Latitude | longitude</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($data as $row)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $row->nama_masjid }}</td>
                                <td>{{ $row->latitude }} {{ $row->longitude }}</td>
                                <td>
                                    <a href="{{ route('masjid.edit', $row->id_masjid) }}" class="btn btn-xs btn-warning"><i class="fas fa-edit"> Edit</i></a>
                                    <form action="{{ route('masjid.destroy', $row->id_masjid) }}" method="POST" style="display: inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-xs btn-flat show_confirm"><i class="fas fa-trash"> Hapus</i></button>
                                    </form>
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
    // titik Lokasi Maps
    var map = L.map('map').setView([-3.658634150357333, 128.18187814633413], 13);

    // menampilkan maps
    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
    }).addTo(map);

    var myIcon = L.icon({
    iconUrl: '{{ asset('ms.png') }}',
    iconSize: [30, 30],
    });


    // membuat mark pada maps
    @foreach($data as $row)
    var marker = L.marker([{{$row->latitude}}, {{$row->longitude}}], {icon: myIcon}).addTo(map);
    marker.bindPopup("<h6><strong>{{$row->nama_masjid}}</strong></h6>")
    @endforeach
</script>
@endsection
