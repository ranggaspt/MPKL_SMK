@extends('layouts.admin')

@section('main-content')
<div class="content">
    <form action="{{ route('instance.complaint.update', Crypt::encrypt($complaints->id)) }}" method="post"
        enctype="multipart/form-data">
        {{ csrf_field() }}
        {{ method_field('put') }}
        <div class="row">
            <div class="col-lg-12 order-lg-1">
                <div class="card shadow mb-4">
                    <div class="card-header">
                        <h4 class="m-0 font-weight-bold text-white">Edit Siswa</h4>
                    </div>
                    <div class="card-body">
                        <div class="pl-lg-4">

                            <div class="form-group{{ $errors->has('student_id') ? ' has-error' : '' }}">
                                <label for="student_id" class="col-md-4 control-label">Siswa</label>
                                <div>
                                    <select class="form-control" name="student_id" required>
                                        @forelse ($student as $students)
                                        <option value="{{$students->id}}" {{$students->student_id == $students->id
                                            ? 'selected' : ''}}>{{$students->name}}</option>
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

                            <div class="form-group{{ $errors->has('message_complaint') ? ' has-error' : '' }}">
                                <label for="message_complaint" class="control-label">Deskripsi Pengaduan</label>
                                <input id="message_complaint" type="text" class="form-control" name="message_complaint"
                                    value="{{ $complaints->message_complaint }}" required>
                                @if ($errors->has('message_complaint'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('message_complaint') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-footer pt-3 border-top">
                            <button type="submit" class="btn btn-primary btn-default">Simpan</button>
                            <a href="{{ route('instance.complaint.index') }}"
                                class="btn btn-secondary btn-default">Kembali</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection