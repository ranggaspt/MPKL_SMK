@extends('layouts.admin')

@section('main-content')
<div class="content">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Siswa</h1>
        {{-- <a href="{{ route('instance.student.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fa fa-plus-circle fa-sm text-white mr-2"></i>Tambah Data</a> --}}
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-white">Data Siswa</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th style="width: 5%">No</th>
                                    <th>NISN</th>
                                    <th>Nama Siswa</th>
                                    <th>Kelas</th>
                                    <th>Jurusan</th>
                                    <th>Guru Pembimbing</th>
                                    <th>Kontak</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($student as $students)
                                <tr>
                                    <td scope="row">{{ $loop->iteration }}</td>
                                    <td>{{ $students->no_identity }}</td>
                                    <td>{{ $students->name }}</td>
                                    <td>{{$students->classroom->name}}</td>
                                    <td>{{ $students->classroom->study->name }}</td>
                                    <td>{{$students->instance->teacher->name}}</td>
                                    <td>Telp : {{$students->phone}}</br>Email : {{$students->email}}</td>
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