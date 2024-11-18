@extends('layouts.web')
@section('content')
<div class="events_section layout_padding">
    <div class="container">
        <h1 class="events_taital">Daftar Qurban</h1>
        <p class="events_text">Beberapa Paket Untuk Berqurban</p>
        <div class="events_section_2">
            <div class="row">
                @foreach($qurban as $row)
                    <div class="col-md-6">
                        <div class="images_main mt-5">
                            @if($row->tipe_hewan == "Sapi")
                                <img src="{{asset('web/images/sapi.jpg')}}" class="image_7">
                            @else
                                <img src="{{asset('web/images/kambing.jpg')}}" class="image_7">
                            @endif
                            <p class="lorem_text">Qurban {{$row->tipe_hewan}}</p>
                        </div>
                        <div class="time_section" style="height: 80px;">
                            <div class="row">
                                <div class="col-7 live_text">Harga: Rp {{number_format($row->harga_per_orang)}}</div>
                                <div class="col-5 date_text">Terdaftar: {{$row->registered}}</div>
                                <div class="col-12 ml-3 mr-1 mt-1">
                                    <form action="{{ route('daftar_qurban.store') }}" method="POST" id="qurban-form-{{ $row->id_seller }}">
                                        @csrf
                                        <input type="hidden" name="id_seller" value="{{ $row->id_seller }}">
                                        <input type="hidden" name="latitude" id="latitude-{{ $row->id_seller }}" value="">
                                        <input type="hidden" name="longitude" id="longitude-{{ $row->id_seller }}" value="">
                                        <input type="hidden" name="tipe_qurban" value="{{ $row->tipe_hewan }}">
                                        <input type="hidden" name="no_hp" value="">
                                        <input type="hidden" name="alamat" value="">
                                        <input type="hidden" name="masjid" value="">
                                        @if(Auth::check())
                                            @if(Auth::user()->role !== "user")
                                                <button class="btn btn-lg btn-warning text-light" type="submit" disabled>
                                                    Anda Sebagai Seller Tidak Bisa Mendaftar
                                                </button>
                                            @else
                                                <button class="btn btn-lg btn-warning text-light" type="button" 
                                                    onclick="confirmRegistration('qurban-form-{{ $row->id_seller }}', '{{ $row->id_seller }}')" 
                                                    {{ $row->quota == 0 ? 'disabled' : '' }}>
                                                    {{ $row->quota == 0 ? 'Kuota Penuh' : 'Daftar' }}
                                                </button>
                                            @endif
                                        @else
                                            <button class="btn btn-lg btn-warning text-light login-required" type="button">
                                                Daftar
                                            </button>
                                        @endif
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- SweetAlert2 CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

<!-- SweetAlert2 JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    $(document).ready(function() {
        // Handle login required notification
        $(document).on('click', '.login-required', function() {
            Swal.fire({
                icon: 'info',
                title: 'Perhatian',
                text: 'Anda harus login terlebih dahulu untuk mendaftar.',
                confirmButtonText: 'Login'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "{{ route('login') }}";
                }
            });
        });

        // Show error notifications if any
        @if(session('error'))
            Swal.fire({
                icon: "warning",
                title: "Oops...",
                text: '{{ session('error') }}',
            });
        @endif
    });

    function getLocation(sellerId) {
        return new Promise((resolve, reject) => {
            if (navigator.geolocation) {
                navigator.permissions.query({ name: 'geolocation' }).then((permissionStatus) => {
                    if (permissionStatus.state === 'granted') {
                        navigator.geolocation.getCurrentPosition(function(position) {
                            const latitude = position.coords.latitude;
                            const longitude = position.coords.longitude;
                            document.getElementById('latitude-' + sellerId).value = latitude;
                            document.getElementById('longitude-' + sellerId).value = longitude;
                            resolve();
                        }, (error) => {
                            let message;
                            switch (error.code) {
                                case error.PERMISSION_DENIED:
                                    message = "Anda perlu mengizinkan akses lokasi.";
                                    break;
                                case error.POSITION_UNAVAILABLE:
                                    message = "Lokasi tidak tersedia. Pastikan GPS dihidupkan.";
                                    break;
                                case error.TIMEOUT:
                                    message = "Permintaan lokasi telah timeout.";
                                    break;
                                case error.UNKNOWN_ERROR:
                                    message = "Terjadi kesalahan yang tidak diketahui.";
                                    break;
                            }
                            Swal.fire({
                                icon: 'error',
                                title: 'Kesalahan',
                                text: message,
                            });
                            reject();
                        });
                    } else if (permissionStatus.state === 'prompt') {
                        Swal.fire({
                            icon: 'info',
                            title: 'Izin Akses Lokasi',
                            text: 'Silakan berikan izin akses lokasi untuk melanjutkan.',
                            showCancelButton: true,
                            confirmButtonText: 'Izinkan',
                            cancelButtonText: 'Batal'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                navigator.geolocation.getCurrentPosition(function(position) {
                                    const latitude = position.coords.latitude;
                                    const longitude = position.coords.longitude;
                                    document.getElementById('latitude-' + sellerId).value = latitude;
                                    document.getElementById('longitude-' + sellerId).value = longitude;
                                    resolve();
                                }, (error) => {
                                    let message;
                                    switch (error.code) {
                                        case error.PERMISSION_DENIED:
                                            message = "Anda perlu mengizinkan akses lokasi.";
                                            break;
                                        case error.POSITION_UNAVAILABLE:
                                            message = "Lokasi tidak tersedia. Pastikan GPS dihidupkan.";
                                            break;
                                        case error.TIMEOUT:
                                            message = "Permintaan lokasi telah timeout.";
                                            break;
                                        case error.UNKNOWN_ERROR:
                                            message = "Terjadi kesalahan yang tidak diketahui.";
                                            break;
                                    }
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Kesalahan',
                                        text: message,
                                    });
                                    reject();
                                });
                            } else {
                                reject(); // Menolak jika pengguna tidak memberikan izin
                            }
                        });
                    } else {
                        Swal.fire({
                            icon: 'warning',
                            title: 'Perhatian',
                            text: 'Akses lokasi ditolak. Silakan aktifkan akses lokasi di pengaturan perangkat.',
                        });
                        reject();
                    }
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Kesalahan',
                    text: 'Geolocation tidak didukung oleh browser ini.',
                });
                reject();
            }
        });
    }


    function confirmRegistration(formId, sellerId) {
        getLocation(sellerId).then(() => {
            Swal.fire({
                title: 'Konfirmasi Pendaftaran',
                html: `
                    <div>
                        <input id="no_hp" type="text" class="swal2-input" placeholder="Masukkan Nomor HP Anda">
                        <input id="alamat" type="text" class="swal2-input" placeholder="Masukkan Alamat Anda:">
                        <select id="masjid" name="masjid" class="swal2-select">
                            <option value="">Pilih Masjid</option>
                            @foreach ($masjid as $row)
                            <option value="{{$row->nama_masjid}}">{{$row->nama_masjid}}</option>
                            @endforeach
                        </select>
                    </div>
                `,
                showCancelButton: true,
                confirmButtonText: 'Daftar',
                cancelButtonText: 'Batal',
                preConfirm: () => {
                    const noHp = document.getElementById('no_hp').value;
                    const alamat = document.getElementById('alamat').value;
                    const masjid = document.getElementById('masjid').value;

                    if (!noHp || !alamat || !masjid) {
                        Swal.showValidationMessage('Semua field harus diisi!');
                        return false;
                    }

                    // Simpan noHp dan alamat dalam hidden input untuk dikirim
                    document.querySelector(`#${formId} input[name='no_hp']`).value = noHp;
                    document.querySelector(`#${formId} input[name='alamat']`).value = alamat;
                    document.querySelector(`#${formId} input[name='masjid']`).value = masjid;
                    return { noHp, alamat, masjid };
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById(formId).submit(); // Submit form if confirmed
                }
            });
        });
    }
</script>
@endsection
