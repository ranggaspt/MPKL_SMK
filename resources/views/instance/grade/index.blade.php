@extends('layouts.admin')

@section('main-content')
<div class="content">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Nilai Kompetensi</h1>
        <a href="{{ route('instance.grade.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fa fa-plus-circle fa-sm text-white mr-2"></i>Tambah Data</a>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-white">Nilai Normatif</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th style="width: 5%">No</th>
                                    <th>Nama Siswa</th>
                                    <th>Disiplin</th>
                                    <th>Kemajuan Kerja dan Motivasi</th>
                                    <th>Kualitas Kerja</th>
                                    <th>Inisiatif dan Kreatifitas</th>
                                    <th>Perilaku</th>
                                    <th style="width: 10%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($grades as $grade)
                                <tr>
                                    <td scope="row">{{ $loop->iteration }}</td>
                                    <td>{{$grade->student->name}}</td>
                                    <td>{{ $grade->option_1 }}</td>
                                    <td>{{ $grade->option_2 }}</td>
                                    <td>{{ $grade->option_3 }}</td>
                                    <td>{{ $grade->option_4 }}</td>
                                    <td>{{ $grade->option_5 }}</td>
                                    <td>
                                        <div class="d-flex">
                                            <div class="mr-2">
                                                <a href="{{ route('instance.grade.edit', Crypt::encrypt($grade->id)) }}" class="btn btn-sm btn-primary">
                                                    <i class="fa fa-pencil-alt"></i>
                                                </a>
                                            </div>
                                            <div class="mr-2">
                                                <form action="{{ route('instance.grade.destroy', Crypt::encrypt($grade->id)) }}" method="post">
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
                                    <td colspan="9">Data Tidak Ditemukan</td>
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