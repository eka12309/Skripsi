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
                    <form action="{{ route('seller.update', $seller->id_seller) }}" method="POST" enctype="multipart/form-data" id="sellerForm">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-lg-6 form-group mb-2">
                                <label for="">Jenis Hewan Qurban <abbr title="" style="color: black">*</abbr></label>
                                <select name="tipe_hewan" id="" class="form-control">
                                    <option value="">Pilih Jenis Hewan Qurban</option>
                                    <option value="Sapi" {{ $seller->tipe_hewan == 'Sapi' ? 'selected' : '' }}>Sapi</option>
                                    <option value="Kambing" {{ $seller->tipe_hewan == 'Kambing' ? 'selected' : '' }}>Kambing</option>
                                </select>
                            </div>
                            <div class="col-lg-6 form-group mb-2">
                                <label for="">Umur Hewan Qurban <abbr title="" style="color: black">*</abbr></label>
                                <input type="number" class="form-control" placeholder="Masukkan Umur Hewan disini...." name="umur_qurban" value="{{ $seller->umur_qurban }}">
                            </div>
                            <div class="col-lg-6 form-group mb-2">
                                <label for="">Harga <abbr title="" style="color: black">*</abbr></label>
                                <input type="number" class="form-control" placeholder="Masukkan Harga Hewan Qurban disini...." name="harga" value="{{ $seller->harga }}">
                            </div>
                            <div class="col-lg-6 form-group mb-2">
                                <label for="">Alamat <abbr title="" style="color: black">*</abbr></label>
                                <input type="text" class="form-control" placeholder="Masukkan Alamat Hewan disini...." name="alamat" value="{{ $seller->alamat }}">
                            </div>
                            <div class="col-lg-12 form-group mb-2">
                                <label for="">No HP <abbr title="" style="color: black">*</abbr></label>
                                <input type="number" class="form-control" placeholder="Masukkan No HP Hewan disini...." name="no_hp" value="{{ $seller->no_hp }}">
                            </div>
                            <!-- Add hidden fields for latitude and longitude -->
                            <input type="hidden" name="latitude" id="latitude" value="{{ $seller->latitude }}">
                            <input type="hidden" name="longitude" id="longitude" value="{{ $seller->longitude }}">
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
        var latitude = parseFloat(document.getElementById('latitude').value) || 0;
        var longitude = parseFloat(document.getElementById('longitude').value) || 0;

        var map = L.map('map').setView([latitude, longitude], 13);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
        }).addTo(map);

        L.marker([latitude, longitude]).addTo(map)
            .bindPopup('Lokasi Hewan Qurban')
            .openPopup();
        
        // Optionally, you can update the latitude and longitude if the user updates the marker
        var marker = L.marker([latitude, longitude], {draggable: true}).addTo(map);

        marker.on('dragend', function (event) {
            var position = event.target.getLatLng();
            document.getElementById('latitude').value = position.lat;
            document.getElementById('longitude').value = position.lng;
        });

        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position) {
                document.getElementById('latitude').value = position.coords.latitude;
                document.getElementById('longitude').value = position.coords.longitude;
                document.getElementById('locationWarning').style.display = 'none'; // Hide warning if location is successfully fetched
                map.setView([position.coords.latitude, position.coords.longitude], 13);
                marker.setLatLng([position.coords.latitude, position.coords.longitude]);
            }, function(error) {
                document.getElementById('locationWarning').style.display = 'block'; // Show warning if there's an error
            });
        } else {
            document.getElementById('locationWarning').style.display = 'block'; // Show warning if geolocation is not supported
        }
    });
</script>
@endsection
