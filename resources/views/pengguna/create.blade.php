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
                    <form action="{{ route('pengguna.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('POST')
                        <div class="row">
                            <div class="col-12 form-group mb-2">
                                <label for="">Nama</label>
                                <input type="text" class="form-control" placeholder="Masukkan Nama disini..." name="name" value="{{ old('name') }}">
                            </div>
                            <div class="col-12 form-group mb-2">
                                <label for="">Email <abbr title="" style="color: black">*</abbr> </label>
                                <input type="email" class="form-control" placeholder="Masukkan Email disini..." name="email" value="{{ old('email') }}">
                            </div>
                            <div class="col-12 form-group mb-2">
                                <label for="role">Role <abbr title="" style="color: black">*</abbr></label>
                                <select class="form-control" id="role" name="role" id="" class="block mt-1 w-full" required autocomplete="role">
                                <option value="">Daftar Sebagai </option>
                                <option value="admin">Sebagai Admin</option>
                                <option value="seller">Sebagai Penjual Qurban</option>
                                <option value="user">Sebagai Pendaftar Qurban</option>
                            </select>
                            </div>
                            <div class="col-12 form-group mb-4">
                                <label for="">Password</label>
                                <input type="password" class="form-control" placeholder="Masukkan Password disini..." name="password" value="{{ old('password') }}">
                            </div>
                            <div class="col-12 form-group mb-4">
                                <label for="">Konfirmasi Password</label>
                                <input type="password" class="form-control" placeholder="Konfirmasi Password disini..." name="password_confirmation" value="{{ old('password_confirmation') }}">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <a href="{{route('pengguna.index')}}" type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</a>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
@section('script')
<script>
    document.getElementById('inputImg').addEventListener('change', function() {
        // Get the file input value and create a URL for the selected image
        var input = this;
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('previewImg').setAttribute('src', e.target.result);
                document.getElementById('previewImg').classList.add("d-block");
            };
            reader.readAsDataURL(input.files[0]);
        }
    });
</script>
  <script>
      CKEDITOR.replace( 'editor', {
          filebrowserUploadMethod: 'form'
      });
  </script>
@endsection
@endsection