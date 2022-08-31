@extends('layouts.app')

@section('title')
Settings
@endsection

@section('css_before')
@endsection

@section('css_after')
@endsection

@section('js_after')
<script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="{{ asset('js/pages/user.js') }}"></script>
@endsection

@section('content')
<div class="container-fluid">
    <!-- Page title -->
    <div class="page-header d-print-none">
        <div class="row align-items-center">
            <div class="col">
                <!-- Page pre-title -->
                <div class="page-pretitle">
                    Manage
                </div>
                <h2 class="page-title">
                    Profile
                </h2>
            </div>
        </div>
    </div>
</div>
<div class="page-body">
    <div class="container-fluid">
        @include('errors.formerror')
        <div class="row row-cards">
            <div class="col-12">
                <form id="userForm" action="{{route('updateprofile')}}" method="post" class="card" enctype='multipart/form-data'>
                    @csrf
                    <div class="card-header">
                        <h3 class="card-title">Update Profile</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-xl-6">
                                <div class="mb-3">
                                    <label class="form-label required">Email</label>
                                    <div>
                                        <input type="email" value="{{Auth::user()->email}}" name="email" class="form-control" placeholder="Enter email" required>
                                        <small class="form-hint"></small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="mb-3">
                                    <label class="form-label required">Name</label>
                                    <div>
                                        <input type="text" value="{{Auth::user()->name}}" name="name" class="form-control" placeholder="Enter name" maxlength="255" required>
                                        <small class="form-hint"></small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            {{-- <div class="col-xl-12">
                                <div class="mb-3">
                                    <label class="form-label required">Username</label>
                                    <div class="input-group mb-2">
                                        <input type="text" value="{{Auth::user()->username}}" name="username" class="form-control" placeholder="Enter username" required>
                                        <small class="form-hint"></small>
                                    </div>
                                </div>
                            </div> --}}
                            <div class="col-xl-6">
                                <div class="mb-3">
                                    <label class="form-label">Profile Picture</label>
                                    <div>
                                        <input type="file" name="avatar" class="form-control">
                                        <small class="form-hint"></small>
                                    </div>
                                </div>
                            </div>
                            @if(@Auth::user()->avatar)
                            <div class="col-xl-6">
                                <div class="mb-3">
                                    <label class="form-label"></label>
                                    <div>
                                        <img height="50" width="50" src="{{Auth::user()->avatar}}">
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                    <div class="card-footer text-end">
                        <div class="d-flex">
                            <a href="{{route('settings')}}" class="btn btn-link">Cancel</a>
                            <button type="submit" class="btn btn-primary ms-auto">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div></br>
        <div class="row row-cards">
            <div class="col-12">
                <form id="userForm" action="{{route('changepassword')}}" method="post" class="card" enctype='multipart/form-data'>
                    @csrf
                    <div class="card-header">
                        <h3 class="card-title">Update Password</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-xl-6">
                                <div class="mb-3">
                                    <label class="form-label required">Current Password</label>
                                    <div>
                                        <input type="password" name="current_password" placeholder="Enter current password" id="current_password" class="form-control" autocomplete="off" required>
                                        <small class="form-hint"></small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-6">
                                <div class="mb-3">
                                    <label class="form-label required">New Password</label>
                                    <div>
                                        <input id="password" type="password" name="password" class="form-control" autocomplete="off"
                                        placeholder="Enter new password" required>
                                        <small class="form-hint"></small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="mb-3">
                                    <label class="form-label required">Confirm Password</label>
                                    <div>
                                        <input id="password_confirmation" type="password" autocomplete="off" name="password_confirmation" class="form-control" placeholder="Confirm password" required>
                                        <small id="password-hint" class="form-hint"></small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-end">
                        <div class="d-flex">
                            <a href="{{route('settings')}}" class="btn btn-link">Cancel</a>
                            <button type="submit" class="btn btn-primary ms-auto">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
</div>
@endsection
