@extends('layouts.admin')

@section('main-content')
<div class="content">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Jurnal</h1>
        {{-- <a href="{{ route('instance.complaint.create') }}"
            class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fa fa-plus-circle fa-sm text-white mr-2"></i>Tambah Data</a> --}}
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
                                    <th style="width: 5%">No</th>
                                    <th>NISN</th>
                                    <th>Nama Siswa</th>
                                    <th>Kelas</th>
                                    <th>Jurusan</th>
                                    <th>Instansi</th>
                                    <th>Di lakukan pada Tanggal</th>
                                    <th>List Kerjaan</th>
                                    <th>Validasi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($journal as $journals)
                                <tr>
                                    <td scope="row">{{ $loop->iteration }}</td>
                                    <td>{{ $journals->student->name }}</td>
                                    <td>{{ $journals->student->no_identity }}</td>
                                    <td>{{ $journals->student->classroom->name}}</td>
                                    <td>{{ $journals->student->classroom->study->name }}</td>
                                    <td>Instansi : {{$journals->instance->instance_name}}</br>Pembimbing :
                                        {{$journals->instance->name}}</td>
                                    <td>{{ date('d-m-Y', strtotime($journals->tanggal))}}</td>
                                    <td>{{ $journals->list_jurnals }}</td>
                                    <td>
                                        @if ( $journals->validation_jurnal == "proses")
                                        <a role="button" class="btn btn-warning disabled" aria-disabled="true">{{ $journals->validation_jurnal }}</a>
                                        @elseif($journals->validation_jurnal == "terima")
                                        <a role="button" class="btn btn-success disabled" aria-disabled="true">{{ $journals->validation_jurnal }}</a>
                                        @elseif ($journals->validation_jurnal == "tolak")
                                        <a role="button" class="btn btn-danger disabled" aria-disabled="true">{{ $journals->validation_jurnal }}</a>
                                        @endif
                                    </td>
                                    
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7">Data Tidak Ditemukan</td>
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