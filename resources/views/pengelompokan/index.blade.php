@extends('layouts.admin')
@section('content')
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{ $title }}</h3>
                    <a href="{{ route('kelompok.create') }}" class="btn btn-dark btn-sm" style="float: right;"><i class="fas fa-plus"> Mulai Pengelompokan</i></a>
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
                                <th>Tipe Hewan</th>
                                <th>Penjual</th>
                                <th>Pendaftar</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $row)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $row->tipe_hewan }}</td>
                                    <td>{{ $row->penjual = ucwords($row->penjual) }}</td>
                                    <td>
                                        @php
                                            $pendaftar = json_decode($row->pendaftar);
                                        @endphp
                                        @if(is_array($pendaftar) && count($pendaftar) > 0)
                                            <ol>
                                                @foreach ($pendaftar as $index => $nama)
                                                    <li>{{ ucwords($nama) }}</li>
                                                @endforeach
                                            </ol>
                                        @else
                                            Tidak ada pendaftar
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('kelompok.edit', $row->id_group) }}" class="btn btn-xs btn-warning"><i class="fas fa-edit"> Edit</i></a>
                                        <form action="{{ route('kelompok.destroy', $row->id_group) }}" method="POST" style="display: inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-xs btn-flat show_confirm"><i class="fas fa-trash"> Hapus</i></button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
@endsection