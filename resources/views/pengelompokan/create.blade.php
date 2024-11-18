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
                        <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                        </ul>
                    </div>
                    @endif
                    <form action="{{ route('kelompok.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('POST')
                        <div class="row">
                            <div class="col-6 form-group mb-2">
                                <label for="role">Penjual <abbr title="" style="color: black">*</abbr></label>
                                <select name="penjual" class="form-control">
                                    <option value="">Pilih Penjual</option>
                                    @foreach ($seller as $row)
                                    <option value="{{$row->name}}">{{$row->name}} | Qurban {{$row->tipe_hewan}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-6 form-group mb-2">
                                <label for="">Tipe Qurban</label>
                                <select class="form-control" name="tipe_hewan" required>
                                    <option value="">Pilih Tipe Hewan</option>
                                    <option value="Sapi">Sapi</option>
                                    <option value="Kambing">Kambing</option>
                                </select>
                            </div>
                            <div class="col-12 form-group mb-2" id="pendaftarContainer">
                                <label for="">Pembeli Qurban <abbr title="" style="color: black">*</abbr> </label>
                                <div class="input-group mb-2">
                                    <select name="pendaftar[]" class="form-control">
                                        <option value="">Pilih Pendaftar Qurban</option>
                                        @foreach ($pendaftar as $row)
                                        <option value="{{$row->name}}, {{$row->alamat}}, {{$row->masjid}}">{{$row->name = ucwords($row->name)}} daftar qurban {{$row->tipe_qurban}}. {{$row->alamat = ucwords($row->alamat)}}, {{$row->masjid = ucwords($row->masjid)}}</option>
                                        @endforeach
                                    </select>
                                    <button type="button" class="btn btn-danger deleteRow" style="display:none;">Hapus</button>
                                </div>
                            </div>
                            <div class="col-12 form-group">
                                <button type="button" id="addPendaftar" class="btn btn-sm btn-success">Tambah Pendaftar</button>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <a href="{{route('kelompok.index')}}" type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</a>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@section('script')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
$(document).ready(function() {
    $('#addPendaftar').on('click', function() {
        var currentSelects = $('#pendaftarContainer select').length;

        if (currentSelects < 7) {
            var newGroup = $('<div class="input-group mb-2"></div>');
            var newSelect = $('<select name="pendaftar[]" class="form-control"></select>').append(
                $('<option value="">Pilih Pendaftar Qurban</option>')
            );

            @foreach ($pendaftar as $row)
            newSelect.append('<option value="{{$row->name}}, {{$row->alamat}}, {{$row->masjid}}">{{$row->name = ucwords($row->name)}} daftar qurban {{$row->tipe_qurban}}. {{$row->alamat = ucwords($row->alamat)}}, {{$row->masjid = ucwords($row->masjid)}}</option>');
            @endforeach

            var deleteButton = $('<button type="button" class="btn btn-danger deleteRow">Hapus</button>');

            newGroup.append(newSelect).append(deleteButton);
            $('#pendaftarContainer').append(newGroup);
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Batas Maksimum',
                text: 'Maksimum 7 pendaftar.',
            });
        }
    });

    // Event delegation to handle dynamic delete buttons
    $('#pendaftarContainer').on('click', '.deleteRow', function() {
        var button = $(this);
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Anda akan menghapus pendaftar ini!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                button.parent().remove(); // Remove the corresponding row
            }
        });
    });
});
</script>
@endsection
@endsection
