
@extends('layouts.home-layout')


@section('css')
<style>
    
</style>
@endsection

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
    <h2 class="mt-2 mb-5">Beranda</h2>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                
                <form method="POST" action="{{ url('/transaksi/add') }}" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="kode" value="{{Auth::user()->kode}}">
                    <input type="file" name="bukti" />
                    <button type="submit" class="btn btn-success">submit</button>
                </form>
            </div>
        </div>
        {{-- {{base64_decode($data->bukti)}} --}}
        {{-- <img src="data:image/jpeg;base64,{{$data->bukti}}" alt="asd" > --}}

        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">5 History Simpanan</h4>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        {{-- <div class="row">
                            @foreach ($simpanan as $data)
                            <div class="col-md-6">
                                <div class="list-group mb-2">
                                    <span class="list-group-item list-group-item-action">
                                        <div class="d-flex w-100 justify-content-between">
                                            <h5 class="mb-1">No. Transaksi : {{$data->no_transaksi}}</h5>
                                            <small class="text-right">{{$data->tgl_deposit}}</small>
                                        </div>
                                        <table class="mb-1">
                                            <tr>
                                                <td>Deposit</td>
                                                <td>:</td>
                                                <td>{{$Helper->revertMoney($data->deposit)}}</td>
                                            </tr>
                                            <tr>
                                                <td>Jenis Simpanan</td>
                                                <td>:</td>
                                                <td>{{$data->jenis_simpanan}}</td>
                                            </tr>
                                            <tr>
                                                <td>Keterangan</td>
                                                <td>:</td>
                                                <td>{{$data->keterangan}}</td>
                                            </tr>
                                        </table>
                                    </span>
                                </div>
                            </div>
                            @endforeach
                        </div> --}}
                    </div>
                </div>
            </div>
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

    // ----- On render -----
$(function() {

$('#profile').addClass('dragging').removeClass('dragging');
});

$('#profile').on('dragover', function() {
$('#profile').addClass('dragging')
}).on('dragleave', function() {
$('#profile').removeClass('dragging')
}).on('drop', function(e) {
$('#profile').removeClass('dragging hasImage');

if (e.originalEvent) {
  var file = e.originalEvent.dataTransfer.files[0];
  console.log(file);

  var reader = new FileReader();

  //attach event handlers here...

  reader.readAsDataURL(file);
  reader.onload = function(e) {
    console.log(reader.result);
    $('#profile').css('background-image', 'url(' + reader.result + ')').addClass('hasImage');

  }

}
})
$('#profile').on('click', function(e) {
console.log('clicked')
$('#mediaFile').click();
});
window.addEventListener("dragover", function(e) {
e = e || event;
e.preventDefault();
}, false);
window.addEventListener("drop", function(e) {
e = e || event;
e.preventDefault();
}, false);
$('#mediaFile').change(function(e) {

var input = e.target;
if (input.files && input.files[0]) {
  var file = input.files[0];

  var reader = new FileReader();

  reader.readAsDataURL(file);
  reader.onload = function(e) {
    console.log(reader.result);
    $('#profile').css('background-image', 'url(' + reader.result + ')').addClass('hasImage');
  }
}
})
</script>

@endsection