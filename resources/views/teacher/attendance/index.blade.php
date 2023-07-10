@extends('layouts.admin')

@section('main-content')
    <div class="content">
        <div class="row">
            <div class="col-lg-12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-white">Data Kehadiran</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th style="width: 5%">No</th>
                                        <th>Nama Siswa</th>
                                        <th>Kelas</th>
                                        <th>Jurusan</th>
                                        <th>Instansi</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($attendance as $attendances)
                                        <tr>
                                            <td scope="row">{{ $loop->iteration }}</td>
                                            <td>{{ $attendances->student->name }}</td>
                                            <td>{{ $attendances->student->classroom->name }}</td>
                                            <td>{{ $attendances->student->classroom->study->name }}</td>
                                            <td>Instansi :
                                                {{ $attendances->student->instance->instance_name }}</br>Pembimbing :
                                                {{ $attendances->student->instance->name }}
                                            </td>
                                            <td>
                                                <a href="{{ route('teacher.attendance.show', Crypt::encrypt($attendances->student->id)) }}"
                                                    class="btn btn-sm btn-info"><i class="bi bi-card-list"></i></a>
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
