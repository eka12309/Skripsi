@extends('layouts.web')
@section('content')
    <!--courses section start -->
    <div class="courses_section layout_padding">
        <div class="container">
            <div class="card">
                <div class="card-head mt-5">
                    <h1 class="courses_taital">Data Qurban</h1>
                </div>
                <div class="card-body table table-responsive">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th scope="col">Nomor</th>
                            <th scope="col">Nama Pendaftar</th>
                            <th scope="col">Daftar Pada Seller</th>
                            <th scope="col">Jenis Hewan Qurban</th>
                            <th scope="col">Harga</th>
                            <th scope="col">alamat</th>
                            <th scope="col">Masjid</th>
                            <th scope="col">Aksi</th> 
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
                                <td>{{ $row->alamat = ucwords($row->alamat) }}</td>
                                <td>{{ $row->masjid = ucwords($row->masjid) }}</td>
                                <td>
                                    @if($row->status_pembayaran == "sukses")
                                        <span class="badge badge-success"><i class="fas fa-check-square"></i> Sudah Dibayar</span>
                                    @else
                                        <a href="{{ route('pendaftaran_saya.show', $row->id_daftar_qurban) }}" class="btn btn-primary btn-sm"><i class="fas fa-money-bill-wave-alt"></i> Bayar</a>
                                    @endif
                                </td>

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
@section('script')
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- SweetAlert2 CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

<!-- SweetAlert2 JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    $(document).ready(function() {
        @if(session('sukses'))
            Swal.fire({
                position: "center",
                icon: "success",
                title: "Berhasil",
                text: '{{ session('sukses') }}',
                showConfirmButton: false,
                timer: 2000
                });
        @endif
    });
</script>
@endsection
