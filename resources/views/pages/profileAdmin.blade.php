
@extends('layouts.layout')


@section('content-app')
<h2 class="mt-2 mb-5">Profile</h2>
<div class="row row-cards">
    <div class="col-12">
        <div class="card">
            <h4 class="card-title ml-3">Ganti Password</h4>
            <div class="card-body mt-4">
                @if (\Session::has('error'))
                    <div class="alert alert-light-danger color-danger"><i class="fas fa-circle-exclamation mr-2"></i> {!! \Session::get('error') !!}</div>
                @endif
                @if (\Session::has('message'))
                    <div class="alert alert-light-success color-success"><i class="fas fa-check mr-2"></i> {!! \Session::get('message') !!}</div>
                @endif
                <div>
                    <form method="post" action="{{ url('/admin/ubah_password') }}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Password Lama</label>
                            <input type="password" name="password_lama" class="form-control" id="exampleInputEmail1" min="0" required placeholder="Password Lama">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Password Baru</label>
                            <input type="password" name="password_baru" class="form-control" id="exampleInputEmail1" min="0" required placeholder="Password Baru">
                        </div>
                        <button type="submit" class="btn btn-success">Submit</button>
                        
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection