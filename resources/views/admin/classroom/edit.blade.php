@extends('layouts.admin')

@section('main-content')
<div class="content">
    <form method="POST" action="{{ route('admin.classroom.update', Crypt::encrypt($data->id)) }}" enctype="multipart/form-data">
        {{ csrf_field() }}
        {{ method_field('put') }}
        <div class="col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header">
                    <h4 class="m-0 font-weight-bold text-white">Edit Kelas</h4>
                </div>
                <div class="card-body">
                    <div class="pl-lg-4">
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Nama Kelas</label>
                            <input id="name" type="text" class="form-control" name="name" value="{{ $data->name }}" required>
                            @if ($errors->has('name'))
                            <span class="help-block">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class="form-group{{ $errors->has('study_id') ? ' has-error' : '' }}">
                            <label for="study_id" class="col-md-4 control-label">Jurusan</label>
                            <div>
                                <select class="form-control" name="study_id" required>
                                    @forelse ($studies as $study)
                                    <option value="{{$study->id}}" {{$data->study_id == $study->id ? 'selected' : ''}}>{{$study->name}}</option>
                                    @empty
                                    <option value="NULL">Jurusan belum diinput</option>
                                    @endforelse
                                </select>
                                @if ($errors->has('study_id'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('study_id') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-footer pt-3 border-top">
                            <button type="submit" class="btn btn-primary btn-default">Simpan</button>
                            <a href="{{ route('admin.classroom.index')}}" class="btn btn-secondary btn-default">Kembali</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
