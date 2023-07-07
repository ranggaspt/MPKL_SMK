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
                                    <th>Rata-rata</th>
                                    <th>Keterangan</th>
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
                                    <td>{{$grade->ratarata}}</td>
                                    <td>
                                        @if($grade->ratarata >= 96 && $grade->ratarata <=100) Lulus Istimewa @elseif($grade->ratarata >= 86 && $grade->ratarata <=95) Lulus Sangat Baik @elseif($grade->ratarata >= 76 && $grade->ratarata <=85) Lulus Baik @elseif($grade->ratarata >= 66 && $grade->ratarata <=75) Lulus Cukup @elseif($grade->ratarata >= 56 && $grade->ratarata <=65) Lulus Sedang @elseif( $grade->ratarata <=55) Belum Lulus @endif </td>
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
                                            <div class='mr-2'>
                                                <button type="button" class="btn btn-sm btn-info" data-toggle="modal" data-target="#myModal">
                                                    <i class="bi bi-info-circle"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <!-- Modal -->
                                <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Informasi Keterangan Nilai</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <p>96-100 Lulus istimewa A</p>
                                                <p>86-95 Lulus sangat baik B</p>
                                                <p>76-85 Lulus Baik C</p>
                                                <p>66-75 Lulus cukup D</p>
                                                <p>56-65 Lulus sedang E</p>
                                                <p>
                                                    <=55 belum Lulus K</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @empty
                                <tr>
                                    <td colspan="10">Data Tidak Ditemukan</td>
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

<script>
    $(document).ready(function() {
        $('#myModal').on('shown.bs.modal', function() {
            $('#nama').focus();
        });
    });
</script>
@endsection