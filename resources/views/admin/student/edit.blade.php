@extends('layouts.admin')

@section('main-content')
<div class="content">
    <form action="{{ route('admin.student.update', Crypt::encrypt($data->id)) }}" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
        {{ method_field('put') }}
        <div class="row">
            <div class="col-lg-4 order-lg-2">
                <div class="card shadow mb-4">
                    <div class="card-header">
                        <h4 class="m-0 font-weight-bold text-white">Foto Profil</h4>
                    </div>
                    <div class="card-profile-image mt-4">
                        <div id="preview-image">
                            <img src="{{ $data->photo == null ? asset('images/preview.png') : asset('storage/'.$data->photo) }}" width="200px" height="250px" />
                        </div>
                    </div>
                    <div class="card-body">
                        <input id="id" type="hidden" class="form-control" name="id" value="{{ $data->id }}">
                        <input id="user_id" type="hidden" class="form-control" name="user_id" value="{{ $data->user_id }}">

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group{{ $errors->has('photo') ? ' has-error' : '' }}">
                                    <input id="photo" type="file" class="form-control preview-image" name="photo" value="{{ old('photo') }}">
                                    @if ($errors->has('photo'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('photo') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-8 order-lg-1">
                <div class="card shadow mb-4">
                    <div class="card-header">
                        <h4 class="m-0 font-weight-bold text-white">Edit Siswa</h4>
                    </div>
                    <div class="card-body">
                        <div class="pl-lg-4">
                            <div class="form-group{{ $errors->has('no_identity') ? ' has-error' : '' }}">
                                <label for="no_identity" class="control-label">Nomor Identitas (NIK)</label>
                                <input id="no_identity" type="text" class="form-control" name="no_identity" value="{{ $data->no_identity }}" required>
                                @if ($errors->has('no_identity'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('no_identity') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-4 control-label">Nama Lengkap</label>
                                <input id="name" type="text" class="form-control" name="name" value="{{ $data->name }}" required>
                                @if ($errors->has('name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('gender') ? ' has-error' : '' }}">
                                <label for="dender" class="col-md-4 control-label">Jenis Kelamin</label>
                                <select class="form-control" name="gender">
                                    <option value="laki-laki" {{$data->gender == 'laki-laki' ? 'selected' : ''}}>Laki - Laki</option>
                                    <option value="perempuan" {{$data->gender == 'perempuan' ? 'selected' : ''}}>Perempuan</option>
                                </select>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
                                        <label for="address" class="col-md-4 control-label">Alamat Peserta</label>
                                        <textarea id="address" class="form-control" name="address"  required>{{ $data->address }}</textarea>@if ($errors->has('address'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('address') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('classroom_id') ? ' has-error' : '' }}">
                                <label for="classroom_id" class="col-md-4 control-label">Kelas</label>
                                <div>
                                    <select class="form-control" name="classroom_id" required>
                                        @forelse ($classrooms as $classroom)
                                        <option value="{{$classroom->id}}" {{$data->classroom_id == $classroom->id ? 'selected' : ''}}>{{$classroom->name}}</option>
                                        @empty
                                        <option value="NULL">Kelas belum diinput</option>
                                        @endforelse
                                    </select>
                                    @if ($errors->has('classroom_id'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('classroom_id') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('instance_id') ? ' has-error' : '' }}">
                                <label for="instance_id" class="col-md-4 control-label">Instansi</label>
                                <div>
                                    <select class="form-control" name="instance_id" required>
                                        @forelse ($instances as $instance)
                                        <option value="{{$instance->id}}" {{$data->instance_id == $instance->id ? 'selected' : ''}}>{{$instance->instance_name}}</option>
                                        @empty
                                        <option value="NULL">Instansi belum diinput</option>
                                        @endforelse
                                    </select>
                                    @if ($errors->has('instance_id'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('instance_id') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                        <label for="email" class="col-md-4 control-label">Email</label>
                                        <input id="email" type="email" class="form-control" name="email" value="{{ $data->email }}" required>
                                        @if ($errors->has('email'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                                        <label for="phone" class="col-md-4 control-label">Telephone</label>
                                        <input id="phone" type="text" class="form-control" name="phone" value="{{ $data->phone }}" required>
                                        @if ($errors->has('phone'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('phone') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                                <label for="username" class="col-md-4 control-label">Username</label>
                                <input id="username" type="text" class="form-control" name="username" value="{{ $data->user->username }}" required>
                                @if ($errors->has('username'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('username') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group focused">
                                        <label class="col-md-4 control-label" for="password">Password</label>
                                        <input type="password" id="password" class="form-control" name="password" placeholder="Password">
                                        @if ($errors->has('password'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group focused">
                                        <label for="password-confirm" class="col-md-10 control-label">Konfirmasi Password</label>
                                        <input type="password" id="password-confirm" class="form-control" name="password_confirmation" autocomplete="password">
                                        @if ($errors->has('password-confirm'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('password-confirm') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="form-footer pt-3 border-top">
                                <button type="submit" class="btn btn-primary btn-default">Simpan</button>
                                <a href="{{ route('admin.student.index') }}" class="btn btn-secondary btn-default">Kembali</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection