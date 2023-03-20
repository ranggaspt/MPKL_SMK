@extends('layouts.admin')

@section('main-content')
<div class="content">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Guru</h1>
        <a href="{{ route('admin.teacher.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fa fa-plus-circle fa-sm text-white mr-2"></i>Tambah Data</a>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-white">Data Guru Pembimbing</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th style="width: 5%">No</th>
                                    <th>NUPTK</th>
                                    <th>Nama Lengkap</th>
                                    <th>Kontak</th>
                                    <th>Alamat</th>
                                    <th style="width: 10%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($teachers as $teacher)
                                <tr>
                                    <td scope="row">{{ $loop->iteration }}</td>
                                    <td>{{$teacher->no_identity}}</td>
                                    <td>{{$teacher->name}}</td>
                                    <td>Telp : {{$teacher->phone}}</br>Email : {{$teacher->email}}</td>
                                    <td>{{ $teacher->address }}</td>
                                    <td>
                                        <div class="d-flex">
                                            <div class="mr-2">
                                                <a href="{{ route('admin.teacher.edit', Crypt::encrypt($teacher->id)) }}" class="btn btn-sm btn-primary">
                                                    <i class="fa fa-pencil-alt"></i>
                                                </a>
                                            </div>
                                            <div class="mr-2">
                                                <form action="{{ route('admin.teacher.destroy', Crypt::encrypt($teacher->id)) }}" method="post">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Anda yakin ingin menghapus data ini?')"><i class="fa fa-trash"></i></button>
                                                </form>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5">Data Tidak Ditemukan</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection