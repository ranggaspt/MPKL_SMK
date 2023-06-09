@extends('layouts.admin')

@section('main-content')
<div class="content">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Pengaduan</h1>
        {{-- <a href="{{ route('instance.complaint.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fa fa-plus-circle fa-sm text-white mr-2"></i>Tambah Data</a> --}}
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-white">Data Pengaduan</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th style="width: 5%">No</th>
                                    <th>Nama Instansi</th>
                                    <th>Nama Pembimbing</th>
                                    <th>Nama Siswa</th>
                                    <th>Deskripsi Complain</th>
                                    <th>Validasi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($complaint as $complaints)
                                <tr>
                                    <td scope="row">{{ $loop->iteration }}</td>
                                    <td>{{ $complaints->instance->instance_name }}</td>
                                    <td>{{$complaints->instance->name}}</td>
                                    <td>{{$complaints->student->name}}</td>
                                    <td>{{ $complaints->message_complaint }}</td>
                                    <td>
                                        @if ($complaints->validation_message == 'proses')
                                        {{-- <button type="button" class="btn btn-success" >Terima</button>
                                        <button type="button" class="btn btn-danger" >Tolak</button> --}}
                                        <a href="{{ route('teacher.complaint.terima', Crypt::encrypt($complaints->id)) }}" class="btn btn-sm btn-success">
                                            Terima
                                        </a>
                                        <a href="{{ route('teacher.complaint.tolak', Crypt::encrypt($complaints->id)) }}" class="btn btn-sm btn-danger">
                                            Tolak
                                        </a>
                                        @elseif($complaints->validation_message == 'terima')
                                        <button type="button" class="btn btn-success" disabled>Terima</button>
                                        @elseif($complaints->validation_message == 'tolak')
                                        <button type="button" class="btn btn-danger" disabled>Tolak</button>
                                        @endif
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6">Data Tidak Ditemukan</td>
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