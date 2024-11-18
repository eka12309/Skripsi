@extends('layouts.web')
@section('content')
    <!--courses section start -->
    <div class="courses_section layout_padding">
        <div class="container">
            <div class="card">
                <div class="card-head mt-5">
                    <h1 class="courses_taital">Pembayaran</h1>
                </div>
                <div class="card-body table table-responsive">
                    @if($pembayaran)
                        <form id="payment-form" data-id="{{ $pembayaran->id_daftar_qurban }}">
                        <table class="table">
                            <input type="hidden" id="token" name="token" value="">
                            <tr>
                                <th style="width: 45%;">Nama Pendaftar</th>
                                <th style="width: 20px;">:</th>
                                <td>{{ $pembayaran->name = ucwords($pembayaran->name) ?? 'Tidak tersedia' }}</td>
                            </tr>
                            <tr>
                                <th style="width: 45%;">Jenis Hewan Qurban</th>
                                <th style="width: 20px;">:</th>
                                <td>{{ $pembayaran->tipe_hewan ?? 'Tidak tersedia' }}</td>
                            </tr>
                            <tr>
                                <th style="width: 45%;">Harga</th>
                                <th style="width: 20px;">:</th>
                                <td>Rp. {{ number_format($pembayaran->harga_per_orang) }}</td>
                            </tr>
                            <tr>
                                <th style="width: 45%;">Alamat</th>
                                <th style="width: 20px;">:</th>
                                <td>{{ $pembayaran->alamat = ucwords($pembayaran->alamat) ?? 'Tidak tersedia' }}</td>
                            </tr>
                            <tr>
                                <th style="width: 45%;">Masjid</th>
                                <th style="width: 20px;">:</th>
                                <td>{{ $pembayaran->masjid = ucwords($pembayaran->masjid) ?? 'Tidak tersedia' }}</td>
                            </tr>
                        </table>
                            <div class="form-group text-right">
                                <button type="button" id="pay-button" class="btn btn-primary float-end"><i class="fas fa-money-bill-wave-alt"></i> Lakukan Pembayaran</button>
                            </div>
                        </form>
                    @else
                        <p>Pembayaran tidak ditemukan.</p>
                    @endif
                </div>
                <div id="map" style="height: 300px;"></div>
            </div>
        </div>
    </div>
    <!--courses section end -->
@endsection
@section('script')
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{env('MIDTRANS_CLIENT_KEY')}}"></script>
    <script type="text/javascript">
      document.getElementById('pay-button').onclick = function(){
        // SnapToken acquired from previous step
        snap.pay('{{$pembayaran->snap_token}}', {
          // Optional
          onSuccess: function(result){
            window.location.href = "{{ route('landing.sukses', $transaksi->id_transaksi) }}";
          },
          // Optional
          onPending: function(result){
            /* You may add your own js here, this is just example */ document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
          },
          // Optional
          onError: function(result){
            /* You may add your own js here, this is just example */ document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
          }
        });
      };
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var map = L.map('map').setView([{{ $pembayaran->latitude }}, {{ $pembayaran->longitude }}], 13); // Default view

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
            }).addTo(map);

            
            var marker = L.marker([{{ $pembayaran->latitude }}, {{ $pembayaran->longitude }}]).addTo(map)
            marker.bindPopup('<strong>{{ $pembayaran->name }}</strong>');
        });
    </script>
@endsection