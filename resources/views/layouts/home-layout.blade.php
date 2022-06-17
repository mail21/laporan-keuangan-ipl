@extends('layouts.anggotaTemplate')

@section('content')
<div id="app">
    @include('layouts.anggota-sidebar') 
    <div id="main" style="background: #f2f7ff; min-height: 100vh">
        @yield('content-app')
    </div>
</div>

@endsection