@extends('layouts.admin')

@section('main-content')
<div class="content">
    <form method="POST" action="{{ route('admin.teacher.store') }}" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="row">
            <div class="col-lg-4 order-lg-2">
                <div class="card shadow mb-4">
                    <div class="card-header">
                        <h4 class="m-0 font-weight-bold text-white">Foto Profil</h4>
                    </div>
                    <div class="card-profile-image mt-4">
                        <div id="preview-image">
                            <img src="{{ asset('images/preview.png') }}" width="200px" height="250px" />
                        </div>
                    </div>
                    <div class="card-body">

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group{{ $errors->has('photo') ? ' has-error' : '' }}">
                                    <input id="photo" type="file" class="form-control preview-image" name="photo" value="{{ old('photo') }}" required>
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
                        <h4 class="m-0 font-weight-bold text-white">Tambah Guru Pembimbing</h4>
                    </div>
                    @include('layouts.components.flash')
                    <div class="card-body">
                        <div class="pl-lg-4">
                            <div class="form-group{{ $errors->has('no_identity') ? ' has-error' : '' }}">
                                <label for="no_identity" class="col-md-6 control-label">Nomor Identitas (NUPTK)</label>
                                <input id="no_identity" type="text" class="form-control" name="no_identity" value="{{ old('no_identity') }}" required>
                                @if ($errors->has('no_identity'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('no_identity') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-4 control-label">Nama Lengkap</label>
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required>
                                @if ($errors->has('name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
                                        <label for="address" class="col-md-4 control-label">Alamat</label>
                                        <textarea id="address" class="form-control" name="address" required>{{ old('address') }}</textarea>
                                        @if ($errors->has('address'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('address') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                        <label for="email" class="col-md-4 control-label">Email</label>
                                        <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>
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
                                        <input id="phone" type="number" class="form-control" name="phone" value="{{ old('phone') }}" required>
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
                                <input id="username" type="text" class="form-control" name="username" value="{{ old('username') }}" required>
                                @if ($errors->has('username'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('username') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group focused">
                                        <label for="password" class="col-md-4 control-label">Password</label>
                                        <input type="password" id="password" class="form-control" name="password">
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
                                        <input type="password" id="password-confirm" class="form-control" name="password_confirmation" required autocomplete="password">
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
                                <a href="{{ route('admin.teacher.index') }}" class="btn btn-secondary btn-default">Kembali</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection