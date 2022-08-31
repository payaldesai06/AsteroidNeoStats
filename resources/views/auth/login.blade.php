@extends('layouts.auth')

@section('content')
@include('errors.formerror')
<form method="POST" action="{{ route('login') }}" autocomplete="off" class="card card-md">
  @csrf
  <div class="card-body">
    <h2 class="card-title text-center mb-4">{{ __('auth.login') }}</h2>

    <div class="mb-3">
      <label class="form-label">{{ __('auth.fields.email') }}</label>
      <input class="form-control" type="email" name="email" placeholder="{{ __('auth.placeholder.email') }}"
        value="{{ old('email') }}" required autofocus tabindex="1" />
    </div>

    <div class="mb-2">
      <label class="form-label">
        {{ __('auth.fields.password') }}
      </label>
      <div class="input-group input-group-flat">
        <input class="form-control" type="password" name="password" placeholder="{{ __('auth.placeholder.password') }}"
          value="{{ old('password') }}" required tabindex="2" />
      </div>
    </div>

    <div class="form-footer">
        <button type="submit" class="btn btn-primary w-100" tabindex="4">{{ __('auth.loginbutton') }}</button>
    </div>
  </div>
</form>

@endsection
