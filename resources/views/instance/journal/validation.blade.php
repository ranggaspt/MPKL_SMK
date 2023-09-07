@extends('layouts.admin')

@section('main-content')
    <div class="content">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Jurnal</h1>
            {{-- <a href="{{ route('instance.journal.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fa fa-plus-circle fa-sm text-white mr-2"></i>Tambah Data</a> --}}
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
                                        <th>Guru Pembimbing</th>
                                        <th>List Kerjaan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($journal as $journals)
                                        <tr>
                                            <td scope="row">{{ $loop->iteration }}</td>
                                            <td>{{ $journals->student->name }}</td>
                                            <td>{{ $journals->student->classroom->name }}</td>
                                            <td>{{ $journals->student->classroom->study->name }}</td>
                                            <td>Guru : {{ $journals->student->teacher->name }}</br>Phone :
                                                {{ $journals->student->teacher->phone }}</td>
                                            <td>
                                                <a href="{{ route('instance.journal.show', Crypt::encrypt($journals->student->id)) }}"
                                                    class="btn btn-sm btn-info"><i class="bi bi-map-fill"></i> Detail</a>
                                            </td>
                                            {{-- <td>
                                        @if ($journals->validation_jurnal == 'proses')
                                        {{-- <button type="button" class="btn btn-success" >Terima</button>
                                        <button type="button" class="btn btn-danger" >Tolak</button> --}}
                                            {{-- <a href="{{ route('instance.journal.terima', Crypt::encrypt($journals->id)) }}" class="btn btn-sm btn-success">
                                            Terima
                                        </a>
                                        <a href="{{ route('instance.journal.tolak', Crypt::encrypt($journals->id)) }}" class="btn btn-sm btn-danger">
                                            Tolak
                                        </a>
                                        @elseif($journals->validation_jurnal == 'terima')
                                        <button type="button" class="btn btn-success" disabled>Terima</button>
                                        @elseif($journals->validation_jurnal == 'tolak')
                                        <button type="button" class="btn btn-danger" disabled>Tolak</button>
                                        @endif
                                    </td> --}}
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
