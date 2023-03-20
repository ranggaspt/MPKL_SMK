@extends('layouts.admin')

@section('main-content')
<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">{{ __('Profile') }}</h1>

@include('layouts.components.flash')

<form method="POST" action="{{ route('instance.profile.update') }}" autocomplete="off" enctype="multipart/form-data">
    {{ csrf_field() }}
    {{ method_field('PUT') }}
    <div class="row">
        <div class="col-lg-4 order-lg-2">
            <div class="card shadow mb-4">
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
                            <div class="text-center">
                                <h5 class="font-weight-bold">{{ $data->instance_name }}</h5>
                                <p>Penyelenggara</p>
                            </div>
                        </div>
                    </div>
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
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-white">My Account</h6>
                </div>
                <div class="card-body">
                    <h6 class="heading-small text-muted mb-4">Informasi Penyelenggara</h6>

                    <div class="pl-lg-4">
                        <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                            <label for="username" class="col-md-4 control-label">Username</label>
                            <input id="username" type="text" class="form-control col-md-6" readonly name="username" value="{{ $data->user->username }}" required>
                            @if ($errors->has('username'))
                            <span class="help-block">
                                <strong>{{ $errors->first('username') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Nama Penyelenggara</label>
                            <input id="name" type="text" class="form-control" name="name" value="{{ $data->name }}" required>
                            @if ($errors->has('name'))
                            <span class="help-block">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class="form-group{{ $errors->has('instance_name') ? ' has-error' : '' }}">
                            <label for="instance_name" class="col-md-4 control-label">Nama Instansi</label>
                            <input id="instance_name" type="text" class="form-control" name="instance_name" value="{{ $data->instance_name }}" required>
                            @if ($errors->has('instance_name'))
                            <span class="help-block">
                                <strong>{{ $errors->first('instance_name') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group{{ $errors->has('instance_address') ? ' has-error' : '' }}">
                                    <label for="instance_address" class="col-md-4 control-label">Alamat Penyelenggara</label>
                                    <textarea id="instance_address" class="form-control" name="instance_address" required>{{ $data->instance_address }}</textarea>
                                    @if ($errors->has('instance_address'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('instance_address') }}</strong>
                                    </span>
                                    @endif
                                </div>
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
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="form-group focused">
                                    <label class="form-control-label" for="current_password">Current password</label>
                                    <input type="password" id="current_password" class="form-control" name="current_password" placeholder="Current password">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group focused">
                                    <label class="form-control-label" for="new_password">New password</label>
                                    <input type="password" id="new_password" class="form-control" name="new_password" placeholder="New password">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group focused">
                                    <label class="form-control-label" for="confirm_password">Confirm password</label>
                                    <input type="password" id="confirm_password" class="form-control" name="password_confirmation" placeholder="Confirm password">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Button -->
                    <div class="pl-lg-4">
                        <div class="row">
                            <div class="col text-center">
                                <button type="submit" class="btn btn-primary">Save Changes</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

@endsection