
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
    <h2 class="mt-2 mb-5">Transaksi</h2>
    <div class="row">
        <div>
            <h3>Pembayaran bulan Juni 2022</h3>
            <form action="">
                
            </form>
        </div>
    </div>
</div>
@endsection()

@section('js')
<script>
    var buttonAjukan = document.getElementById('btn_ajukan');
    var modal = document.getElementById('exampleModal');

    // console.log(modal)

    buttonAjukan.addEventListener('click', () => {

        var dengan_rupiah = document.getElementById('dengan-rupiah');
        dengan_rupiah.addEventListener('keyup', function(e) {
            dengan_rupiah.value = formatRupiah(this.value);
        });

        /* Fungsi */
        function formatRupiah(angka, prefix) {
            var number_string = angka.replace(/[^,\d]/g, '').toString(),
                split = number_string.split(','),
                sisa = split[0].length % 3,
                rupiah = split[0].substr(0, sisa),
                ribuan = split[0].substr(sisa).match(/\d{3}/gi);

            if (ribuan) {
                separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }

            rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
            return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
        }
    })
</script>

@endsection