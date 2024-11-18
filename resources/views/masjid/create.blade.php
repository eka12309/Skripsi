@extends('layouts.admin')
@section('content')
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{ $title }}</h3>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <strong>Error!</strong> 
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                        </ul>
                    </div>
                    @endif
                    <div id="locationWarning" class="alert alert-warning" style="display: none;">
                        <strong>Warning!</strong> Harap Aktifkan Layanan Lokasi dan Berikan Izin Untuk Mengakses Lokasi Anda.
                    </div>
                    <form action="{{ route('masjid.store') }}" method="POST" enctype="multipart/form-data" id="sellerForm">
                        @csrf
                        @method('POST')
                        <div class="row">
                            <div class="col-lg-12 form-group mb-2">
                                <label for="">Nama Masjid <abbr title="" style="color: black">*</abbr></label>
                                <input type="text" class="form-control" placeholder="Masukkan Nama Masjid disini...." name="nama_masjid" value="{{ old('nama_masjid') }}">
                            </div>
                            <div class="col-lg-12 form-group mb-2">
                                <label for="">Maps</label>
                                <div id="map">
                                </div>
                            </div>
                            <div class="col-lg-12 form-group mb-2">
                                <label for="">Latitude</label>
                                <input type="text" name="latitude" id="latitude" class="form-control" value="{{ old('latitude') }}">
                            </div>
                            <div class="col-lg-12 form-group mb-2">
                                <label for="">Longitude</label>
                                <input type="text" name="longitude" class="form-control" id="longitude" value="{{ old('longitude') }}">
                            </div>
                            <div class="col-lg-2 form-group mb-2">
                                <button type="submit" class="btn btn-dark"><i class="fas fa-save"></i> Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
<script>
    // titik Lokasi Maps
    var map = L.map('map').setView([-3.6726175762942876, 128.20095701458646], 14);

    // menampilkan maps
    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
    }).addTo(map);

    // membuat mark pada maps
    // var marker = L.marker([-3.6988652520988445, 128.17786254762765]).addTo(map);
    // marker.bindPopup("<br>Hello ini mark pertama</br><br>ini popup</br>")

    let marker = null;
    map.on('click', (event)=> {

    if(marker !== null){
        map.removeLayer(marker);
    }

    marker = L.marker([event.latlng.lat , event.latlng.lng]).addTo(map);
    document.getElementById('latitude').value = event.latlng.lat;
    document.getElementById('longitude').value = event.latlng.lng;
    
})
</script>
@endsection
