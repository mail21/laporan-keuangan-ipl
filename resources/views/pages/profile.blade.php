
@extends('layouts.home-layout')


@section('content-app')
<header class="mb-3">
    <div class="row">

        <div class="col-md-12 mb-3 text-right">
            <a href="#" class="d-inline burger-btn d-block d-xl-none float-left mt-3">
                <i class="fas fa-bars fs-3"></i>
            </a>

            <div class="dropdown show">
                <h2 class="d-inline p-2">{{Auth::user()->nama . " " . Auth::user()->kode}}</h2>
            </div>
        </div>
    </div>
</header>
<div class="page-content">
    <h2 class="mt-2 mb-5">Profile</h2>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Ganti Password</h4>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        @if (\Session::has('error'))
                            <div class="alert alert-light-danger color-danger"><i class="fas fa-circle-exclamation mr-2"></i> {!! \Session::get('error') !!}</div>
                        @endif
                        @if (\Session::has('message'))
                            <div class="alert alert-light-success color-success"><i class="fas fa-check mr-2"></i> {!! \Session::get('message') !!}</div>
                        @endif
                       <div>
                            <form method="post" action="{{ url('/user/ubah_password') }}">
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
    </div>
</div>
@endsection()
