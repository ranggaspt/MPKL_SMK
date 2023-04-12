@extends('layouts.admin')

@section('main-content')
<div class="content">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Jurnal</h1>
        {{-- <a href="{{ route('instance.complaint.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fa fa-plus-circle fa-sm text-white mr-2"></i>Tambah Data</a> --}}
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-white">Data Jurnal</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    {{-- <th style="width: 5%">No</th> --}}
                                    <th>NISN</th>
                                    <th>Nama Siswa</th>
                                    <th>Kelas</th>
                                    <th>Jurusan</th>
                                    <th>Instansi</th>
                                    <th>List Kerjaan</th>
                                    <th>Validasi</th>
                                    <th style="width: 10%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($complaint as $complaints)
                                <tr>
                                    <td scope="row">{{ $loop->iteration }}</td>
                                    <td>{{ $complaints->name_instance }}</td>
                                    <td>Instansi : {{$complaints->address_instance}}</br>Guru : {{$complaints->name_teacher}}</td>
                                    <td>{{ $complaints->name_student }}</td>
                                    <td>{{$complaints->complaint_message}}</td>
                                    <td>{{ $complaints->validation_message }}</td>
                                    <td>
                                        {{-- <div class="d-flex">
                                            <div class="mr-2">
                                                <a href="{{ route('admin.complaint.edit', Crypt::encrypt($complaints->id)) }}" class="btn btn-sm btn-primary">
                                                    <i class="fa fa-pencil-alt"></i>
                                                </a>
                                            </div>
                                            <div class="mr-2">
                                                <form action="{{ route('admin.complaint.destroy', Crypt::encrypt($complaints->id)) }}" method="post">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Anda yakin ingin menghapus data ini?')"><i class="fa fa-trash"></i></button>
                                                </form>
                                            </div>
                                        </div> --}}
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="8">Data Tidak Ditemukan</td>
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