{{-- @if ($errors->any())
<div class="alert alert-danger" role="alert">
    {{ __('auth.error') }}: {{ $errors->first() }}
</div>
@endif --}}
@if(session()->has('success'))
    <div class="alert alert-success">
        {{ session()->get('success') }}
    </div>
@endif
@if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif
@if (\Session::has('error'))
    <div class="alert alert-danger">
        {!! \Session::get('error') !!}
    </div>
@endif
