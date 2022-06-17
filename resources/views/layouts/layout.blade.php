@extends('layouts.template')

@section('content')
{{-- <div id="app">
    <div id="main" style="background: #f2f7ff; min-height: 100vh">
    </div>
</div> --}}

    @include('layouts.header') 
    @include('layouts.sidebar') 
    <main id="main" class="main">

    @yield('content-app')
    </main>
    
    @include('layouts.footer') 

  

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>


  @endsection