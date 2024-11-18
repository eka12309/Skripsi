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
                    <form action="{{ route('seller.store') }}" method="POST" enctype="multipart/form-data" id="sellerForm">
                        @csrf
                        @method('POST')
                        <div class="row">
                            <div class="col-lg-6 form-group mb-2">
                                <label for="">Jenis Hewan Qurban <abbr title="" style="color: black">*</abbr></label>
                                <select name="tipe_hewan" id="" class="form-control">
                                    <option value="">Pilih Jenis Hewan Qurban</option>
                                    <option value="Sapi">Sapi</option>
                                    <option value="Kambing">Kambing</option>
                                </select>
                            </div>
                            <div class="col-lg-6 form-group mb-2">
                                <label for="">Umur Hewan Qurban <abbr title="" style="color: black">*</abbr></label>
                                <input type="number" class="form-control" placeholder="Masukkan Umur Hewan disini...." name="umur_qurban" value="{{ old('umur_qurban') }}">
                            </div>
                            <div class="col-lg-6 form-group mb-2">
                                <label for="">Harga <abbr title="" style="color: black">*</abbr></label>
                                <input type="number" class="form-control" placeholder="Masukkan Harga Hewan Qurban disini...." name="harga" value="{{ old('harga') }}">
                            </div>
                            <div class="col-lg-6 form-group mb-2">
                                <label for="">Alamat <abbr title="" style="color: black">*</abbr></label>
                                <input type="text" class="form-control" placeholder="Masukkan Alamat Hewan disini...." name="alamat" value="{{ old('alamat') }}">
                            </div>
                            <div class="col-lg-12 form-group mb-2">
                                <label for="">No HP <abbr title="" style="color: black">*</abbr></label>
                                <input type="number" class="form-control" placeholder="Masukkan No HP Hewan disini...." name="no_hp" value="{{ old('no_hp') }}">
                            </div>
                            <!-- Add hidden fields for latitude and longitude -->
                            <input type="hidden" name="latitude" id="latitude" value="">
                            <input type="hidden" name="longitude" id="longitude" value="">
                            <div class="col-lg-12 form-group mb-2">
                                <label for="">Lokasi</label>
                                <div id="map" style="height: 400px;"></div>
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
    document.addEventListener('DOMContentLoaded', function () {
        var map = L.map('map').setView([0, 0], 13); // Default view

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
        }).addTo(map);

        var marker = L.marker([0, 0], {draggable: true}).addTo(map);

        marker.on('dragend', function (event) {
            var position = event.target.getLatLng();
            document.getElementById('latitude').value = position.lat;
            document.getElementById('longitude').value = position.lng;
        });

        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position) {
                var latitude = position.coords.latitude;
                var longitude = position.coords.longitude;
                document.getElementById('latitude').value = latitude;
                document.getElementById('longitude').value = longitude;
                document.getElementById('locationWarning').style.display = 'none'; // Hide warning
                map.setView([latitude, longitude], 13);
                marker.setLatLng([latitude, longitude]);
            }, function(error) {
                document.getElementById('locationWarning').style.display = 'block'; // Show warning
            });
        } else {
            document.getElementById('locationWarning').style.display = 'block'; // Show warning
        }
    });
</script>
@endsection
