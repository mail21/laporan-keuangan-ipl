<!doctype html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Language" content="en" />
    <meta name="msapplication-TileColor" content="#2d89ef">
    <meta name="theme-color" content="#4188c9">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent" />
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="HandheldFriendly" content="True">
    <meta name="MobileOptimized" content="320">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Laporan Keuangan Green Arka Serpong 1</title>
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.css') }}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,300i,400,400i,500,500i,600,600i,700,700i&amp;subset=latin-ext">

    {{-- <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/vendors/iconly/bold.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/vendors/perfect-scrollbar/perfect-scrollbar.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/bootstrap-icons/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/pages/auth.css') }}">
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.svg') }}" type="image/x-icon"> --}}

    <!-- Dashboard Core -->
    {{-- <link href="{{ asset('css/styles.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/new.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/dashboard.css') }}" rel="stylesheet" />
    <script src="{{ asset('js/dashboard.js') }}"></script> --}}
    <!-- c3.js') }} Charts Plugin -->
    {{-- <link href="{{ asset('plugins/charts-c3/plugin.css') }}" rel="stylesheet" />
    <script src="{{ asset('plugins/charts-c3/plugin.js') }}"></script>
    <!-- Google Maps Plugin -->
    <link href="{{ asset('plugins/maps-google/plugin.css') }}" rel="stylesheet" />
    <script src="{{ asset('plugins/maps-google/plugin.js') }}"></script>
    <!-- Input Mask Plugin -->
    <script src="{{ asset('plugins/input-mask/plugin.js') }}"></script>
    <!-- Datatables Plugin -->
    <script src="{{ asset('plugins/datatables/plugin.js') }}"></script>
    <!-- Datepicker Plugin -->
    <link href="{{ asset('plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}" rel="stylesheet" />
    <script src="{{ asset('plugins/bootstrap-datepicker/plugin.js') }}"></script> --}}
    


    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script> --}}
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.11.4/datatables.min.css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha/css/bootstrap.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    {{-- <link rel="stylesheet" href="{{ asset('assets/vendors/jquery-datatables/jquery.dataTables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/jquery-datatables/jquery.dataTables.bootstrap5.min.css') }}"> --}}
    {{-- <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css"> --}}
    
    {{-- nice admin template --}}
        <!-- Favicons -->
        {{-- <link href="assets/img/favicon.png" rel="icon">
        <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon"> --}}

        <!-- Google Fonts -->
        <link href="https://fonts.gstatic.com" rel="preconnect">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

        <!-- Vendor CSS Files -->
        <link href="{{asset("vendorNiceAdmin/bootstrap/css/bootstrap.min.css")}}" rel="stylesheet">
        <link href="{{asset("vendorNiceAdmin/bootstrap-icons/bootstrap-icons.css")}}" rel="stylesheet">
        <link href="{{asset("vendorNiceAdmin/boxicons/css/boxicons.min.css")}}" rel="stylesheet">
        <link href="{{asset("vendorNiceAdmin/quill/quill.snow.css")}}" rel="stylesheet">
        <link href="{{asset("vendorNiceAdmin/quill/quill.bubble.css")}}" rel="stylesheet">
        <link href="{{asset("vendorNiceAdmin/remixicon/remixicon.css")}}" rel="stylesheet">
        <link href="{{asset("vendorNiceAdmin/simple-datatables/style.css")}}" rel="stylesheet">

        <link href="{{ asset('cssNiceAdmin/styleNiceAdmin.css') }}" rel="stylesheet">

    {{-- nice admin end template --}}


    @yield('css')
</head>

<body class="">
    @yield('content')
</body>
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.0/dist/chart.min.js"></script>

{{-- 
<script src="{{ asset('assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>

<script src="{{ asset('assets/vendors/apexcharts/apexcharts.js') }}"></script>
<script src="{{ asset('assets/js/pages/dashboard.js') }}"></script>

<script src="{{ asset('assets/js/mazer.js') }}"></script>



<!-- <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.11.4/datatables.min.js"></script> -->
<script type="text/javascript" src="{{ asset('assets/vendors/jquery-datatables/jquery.dataTables.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/vendors/jquery-datatables/jquery.dataTables.bootstrap5.min.js') }}"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
 --}}
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
 <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>

    {{-- nice admin template --}}
       <!-- Vendor JS Files -->
        <script src="{{asset('vendorNiceAdmin/apexcharts/apexcharts.min.js')}}"></script>
        <script src="{{asset('vendorNiceAdmin/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
        <script src="{{asset('vendorNiceAdmin/chart.js/chart.min.js')}}"></script>
        <script src="{{asset('vendorNiceAdmin/echarts/echarts.min.js')}}"></script>
        <script src="{{asset('vendorNiceAdmin/quill/quill.min.js')}}"></script>
        <script src="{{asset('vendorNiceAdmin/simple-datatables/simple-datatables.js')}}"></script>
        <script src="{{asset('vendorNiceAdmin/tinymce/tinymce.min.js')}}"></script>
        <script src="{{asset('vendorNiceAdmin/php-email-form/validate.js')}}"></script>

        <!-- Template Main JS File -->
        <script src="{{ asset('js/jsNiceAdmin.js') }}/"></script>

    {{-- nice admin end template --}}
@yield('js')


</html>