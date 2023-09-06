@extends('layouts.admin')

@section('main-content')
<div class="content">
    <form method="POST" action="{{ route('instance.grade.store') }}" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="row">
            <div class="col-lg-8 order-lg-1">
                <div class="card shadow mb-4">
                    <div class="card-header">
                        <h4 class="m-0 font-weight-bold text-white">Tambah Nilai</h4>
                    </div>
                    @include('layouts.components.flash')
                    <div class="card-body">
                        <div class="pl-lg-4">
                            <div class="form-group{{ $errors->has('student_id') ? ' has-error' : '' }}">
                                <label for="student_id" class="col-md-4 control-label">Siswa</label>
                                <div>
                                    <select class="form-control" name="student_id" required>
                                        <option>Pilih Siswa</option>
                                        @forelse ($student as $students)
                                            @php
                                                $grades = $students->grades;
                                                $hasGrades = !empty($grades) && $grades->isNotEmpty();
                                            @endphp
                                            @if (!$hasGrades)
                                                <option value="{{$students->id}}">{{$students->name}}</option>
                                            @endif
                                        @empty
                                            <option value="NULL">Siswa belum diinput</option>
                                        @endforelse
                                    </select>
                                    @if ($errors->has('student_id'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('student_id') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>                                                                           

                            <div class="form-group{{ $errors->has('option_1') ? ' has-error' : '' }}">
                                <label for="option_1" class="col-md-6 control-label">Disiplin Waktu</label>
                                <input id="option_1" type="number" class="form-control" name="option_1" value="{{ old('option_1') }}" required>
                                @if ($errors->has('option_1'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('option_1') }}</strong>
                                </span>
                                @endif
                            </div>

                            <div class="form-group{{ $errors->has('option_2') ? ' has-error' : '' }}">
                                <label for="option_2" class="col-md-6 control-label">Kemajuan Kerja dan Motivasi</label>
                                <input id="option_2" type="number" class="form-control" name="option_2" value="{{ old('option_2') }}" required>
                                @if ($errors->has('option_2'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('option_2') }}</strong>
                                </span>
                                @endif
                            </div>

                            <div class="form-group{{ $errors->has('option_3') ? ' has-error' : '' }}">
                                <label for="option_3" class="col-md-6 control-label">Kualitas Kerja</label>
                                <input id="option_3" type="number" class="form-control" name="option_3" value="{{ old('option_3') }}" required>
                                @if ($errors->has('option_3'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('option_3') }}</strong>
                                </span>
                                @endif
                            </div>

                            <div class="form-group{{ $errors->has('option_4') ? ' has-error' : '' }}">
                                <label for="option_4" class="col-md-6 control-label">Inisiatif dan Kreatifitas</label>
                                <input id="option_4" type="number" class="form-control" name="option_4" value="{{ old('option_4') }}" required>
                                @if ($errors->has('option_4'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('option_4') }}</strong>
                                </span>
                                @endif
                            </div>

                            <div class="form-group{{ $errors->has('option_5') ? ' has-error' : '' }}">
                                <label for="option_5" class="col-md-6 control-label">Perilaku</label>
                                <input id="option_5" type="number" class="form-control" name="option_5" value="{{ old('option_5') }}" required>
                                @if ($errors->has('option_5'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('option_5') }}</strong>
                                </span>
                                @endif
                            </div>
                            
                            <div class="form-footer pt-3 border-top">
                                <button type="submit" class="btn btn-primary btn-default">Simpan</button>
                                <a href="{{ route('instance.grade.index') }}" class="btn btn-secondary btn-default">Kembali</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection