@extends('layouts.auth')

@section('content')
<div class="card-body">
    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif
    <form method="POST" class="card card-md" action="{{ route('password.email') }}">
        @csrf
        <div class="card-body">
            <h2 class="card-title text-center mb-4">Reset Password</h2>
            <div class="mb-3">
                <label class="form-label">{{ __('auth.fields.email') }}</label>
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                  @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                   @enderror
              </div>
            <div class="form-footer">
                <button type="submit" class="btn btn-primary w-100" tabindex="4">{{ __('Send Password Reset Link') }}</button>
            </div>
        </div>
    </form>
    <div class="text-center text-muted mt-3">
        <a href="{{ route('login') }}" tabindex="-1">Login</a>
    </div>
</div>
@endsection
