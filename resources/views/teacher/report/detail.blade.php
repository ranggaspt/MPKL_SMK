@extends('layouts.admin')

@section('main-content')
<div class="content">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Laporan Magang</h1>
        {{-- <a href="{{ route('teacher.attendance.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fa fa-plus-circle fa-sm text-white mr-2"></i>Tambah Data</a> --}}
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-white">Data Laporan Magang</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th style="width: 5%">No</th>
                                    <th>Tanggal</th>
                                    <th>Laporan Magang</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($report as $reports)
                                <tr>
                                    <td scope="row">{{ $loop->iteration }}</td>
                                    <td>{{ date('d-m-Y', strtotime($reports->tanggal)) }}</td>
                                    <td> Deskripsi : {{$reports->description}}<br> Link Download : <a href="{{url('teacher/report/download/'.$reports->file)}}" class="btn btn-sm btn-primary"> <i class="bi bi-download"></i> Download</a></td>
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