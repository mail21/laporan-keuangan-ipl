@extends('layouts.template')

@section('content')
<div class="d-flex justify-content-center align-items-center" style="height: 100vh">
    <div style="width: 50%;background:white;padding:20px;border-radius:7px;">
        <h3 class="text-center text-dark mb-5">Log in</h3>
        <form method="post" action="{{ route('login') }}">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="form-group position-relative has-icon-left mb-4">
                <input id="kode" type="text" class="form-control{{ $errors->has('kode') ? ' is-invalid' : '' }}" name="kode" value="{{ old('kode') }}" required autofocus placeholder="kode">
                @if ($errors->has('kode'))
                <span class="invalid-feedback">{{ $errors->first('kode') }}</span>
                @endif
                
            </div>
            <div class="form-group position-relative has-icon-left mb-4">
                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="Password" name="password" required>
                @if ($errors->has('password'))
                <span class="invalid-feedback">{{ $errors->first('password') }}</span>
                @endif
                
            </div>
            
            <button type="submit" class="btn btn-primary btn-block btn-lg shadow-lg mt-5">Log in</button>
        </form>
        @if (Session::has('success'))
        <div class="alert alert-success mt-3">
            {{ Session::get('success') }}
        </div>
        @endif
        @if (Session::has('error'))
        <div class="alert alert-danger mt-3">
            {{ Session::get('error') }}
        </div>
        @endif
    </div>
</div>
@endsection