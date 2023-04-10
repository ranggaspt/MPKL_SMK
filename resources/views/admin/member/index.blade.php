@extends('layouts.admin')

@section('main-content')
<div class="content">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Siswa</h1>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <div class="d-flex align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-white">Data Siswa</h6>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th style="width: 5%">No</th>
                                    <th>NISN</th>
                                    <th>Nama Lengkap</th>
                                    <th>Kelas</th>
                                    <th>Jurusan</th>
                                    <th>Instansi</th>
                                    <th>Kontak</th>
                                    <th>Pembimbing</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($students as $student)
                                <tr>
                                    <td scope="row">{{ $loop->iteration }}</td>
                                    <td>{{ $student->no_identity }}</td>
                                    <td>{{ $student->name }}</td>
                                    <td>{{ $student->classroom->name }}</td>
                                    <td>{{ $student->classroom->study->name }}</td>
                                    <td>{{ $student->instance->instance_name}}</td>
                                    <td>Telp : {{$student->phone}}</br>Email : {{$student->email}}</td>
                                    <td>Guru : {{$student->instance->name}}</br>Instansi : {{$student->instance->teacher->name}}</td>
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