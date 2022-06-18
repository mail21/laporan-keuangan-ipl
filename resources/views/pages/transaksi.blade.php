
@extends('layouts.layout')


@section('css')
<style>
    
    .body-form{
        box-sizing: border-box;
        font-size: 16px;
    }
    .uploader {
        display: block;
        clear: both;
        margin: 0 auto;
        width: 100%;
        padding: 20px;
        /* max-width: 600px;  */
    }
    .uploader .label-upload {
        float: left;
        clear: both;
        width: 100%;
        padding: 2rem 1.5rem;
        text-align: center;
        background: #fff;
        border-radius: 7px;
        border: 3px solid #eee;
        transition: all 0.2s ease;
        user-select: none;
    }
    .uploader .label-upload:hover {
        border-color: #454cad;
    }
    .uploader .label-upload.hover {
        border: 3px solid #454cad;
        box-shadow: inset 0 0 0 6px #eee;
    }
    .uploader .label-upload.hover #start i.fa {
        transform: scale(0.8);
        opacity: 0.3;
    }
    .uploader #start {
        float: left;
        clear: both;
        width: 100%;
    }
    .uploader #start.hidden {
        display: none;
    }
    .uploader #start i.fa {
        font-size: 50px;
        margin-bottom: 1rem;
        transition: all 0.2s ease-in-out;
    }
    .uploader #response {
        float: left;
        clear: both;
        width: 100%;
    }
    .uploader #response.hidden {
        display: none;
    }
    .uploader #response #messages {
        margin-bottom: 0.5rem;
    }
    .uploader #file-image {
        display: inline;
        margin: 0 auto 0.5rem auto;
        width: auto;
        height: auto;
        max-width: 180px;
    }
    .uploader #file-image.hidden {
        display: none;
    }
    .uploader #notimage {
        display: block;
        float: left;
        clear: both;
        width: 100%;
    }
    .uploader #notimage.hidden {
        display: none;
    }
    .uploader progress, .uploader .progress {
        display: inline;
        clear: both;
        margin: 0 auto;
        width: 100%;
        max-width: 180px;
        height: 8px;
        border: 0;
        border-radius: 4px;
        background-color: #eee;
        overflow: hidden;
    }
    .uploader .progress[value]::-webkit-progress-bar {
        border-radius: 4px;
        background-color: #eee;
    }
    .uploader .progress[value]::-webkit-progress-value {
        background: linear-gradient(to right, #393f90 0%, #454cad 50%);
        border-radius: 4px;
    }
    .uploader .progress[value]::-moz-progress-bar {
        background: linear-gradient(to right, #393f90 0%, #454cad 50%);
        border-radius: 4px;
    }
    .uploader input[type="file"] {
        display: none;
    }
    .uploader div {
        margin: 0 0 0.5rem 0;
        color: #5f6982;
    }
    .uploader .btn {
        display: inline-block;
        margin: 0.5rem 0.5rem 1rem 0.5rem;
        clear: both;
        font-family: inherit;
        font-weight: 700;
        font-size: 14px;
        text-decoration: none;
        text-transform: initial;
        border: none;
        border-radius: 0.2rem;
        outline: none;
        padding: 0 1rem;
        height: 36px;
        line-height: 36px;
        color: #fff;
        transition: all 0.2s ease-in-out;
        box-sizing: border-box;
        background: #454cad;
        border-color: #454cad;
        cursor: pointer;
    }
 
</style>
@endsection

@section('content-app')
@php
    $namaBulans = array('00' => 'All',"01"=>"Januari", "02"=>"Februari", "03"=>"Maret", "04"=>"April", "05"=>"Mei", "06"=>"Juni", "07"=>"Juli", "08"=>"Agustus", "09"=>"September", "10"=>"Oktober", "11"=>"November", "12"=>"Desember");
@endphp
<h2 class="mt-2 mb-5">Transaksi</h2>
<div class="row row-cards">
    <div class="col-12">
        <div class="row mb-3">
            <div class="col-md-12">
                @if (\Session::has('error'))
                <div class="alert alert-light-danger color-danger"><i class="fas fa-circle-exclamation mr-2"></i> {!! \Session::get('error') !!}</div>
                @endif
                @if (\Session::has('message'))
                @php 
                    $arr = json_decode(\Session::get('message'));
                @endphp
                <div class="alert alert-light-success color-success d-flex justify-content-between align-items-center">
                    <span>
                        <i class="fas fa-check mr-2"></i> {{$arr->pesan}}
                    </span>
                </div>
                @endif
            </div>
            <div class="col-md-12 d-flex" style="gap: 10px;">
                <div class="form-group">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                        {{$tahun ? 'Tahun - ' . $tahun : 'Pilih Tahun'}}
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                        <li><a class="dropdown-item" href="{{ url('/transaksi?tahun='. '2022') }}">2022</a></li>
                        <li><a class="dropdown-item" href="{{ url('/transaksi?tahun='. '2023') }}">2023</a></li>
                        <li><a class="dropdown-item" href="{{ url('/transaksi?tahun='. '2024') }}">2024</a></li>
                    </ul>
                </div>
                <div class="form-group">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                        {{$bulan ? 'Bulan - ' . $namaBulans[$bulan] : 'Pilih Bulan'}}
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                        @foreach ($namaBulans as $key => $item)
                            <li><a class="dropdown-item" href="{{ url('/transaksi?bulan='. $key . '&tahun='. $tahun ) }}">{{$item}}</a></li>
                        @endforeach
                    </ul>
                </div>
                <div class="form-group">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                        {{$status ? 'Status - ' . $status : 'Pilih Status'}}
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                        <li><a class="dropdown-item" href="{{ url("/transaksi?status=all&bulan=$bulan&tahun=$tahun&area=$area") }}">All</a></li>
                        <li><a class="dropdown-item" href="{{ url("/transaksi?status=approve&bulan=$bulan&tahun=$tahun&area=$area") }}">Approve</a></li>
                        <li><a class="dropdown-item" href="{{ url("/transaksi?status=pending&bulan=$bulan&tahun=$tahun&area=$area") }}">Pending</a></li>
                        <li><a class="dropdown-item" href="{{ url("/transaksi?status=reject&bulan=$bulan&tahun=$tahun&area=$area") }}">Reject</a></li>
                        <li><a class="dropdown-item" href="{{ url("/transaksi?status=no&bulan=$bulan&tahun=$tahun&area=$area") }}">No Payment</a></li>
                    </ul>
                </div>    
                <div class="form-group">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                        {{$area ? 'Area - ' . $area : 'Pilih Area'}}
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                        <li><a class="dropdown-item" href="{{ url("/transaksi?area=all&status=$status&bulan=$bulan&tahun=$tahun") }}">All</a></li>
                        <li><a class="dropdown-item" href="{{ url("/transaksi?area=a&status=$status&bulan=$bulan&tahun=$tahun") }}">A</a></li>
                        <li><a class="dropdown-item" href="{{ url("/transaksi?area=b&status=$status&bulan=$bulan&tahun=$tahun") }}">B</a></li>
                        <li><a class="dropdown-item" href="{{ url("/transaksi?area=c&status=$status&bulan=$bulan&tahun=$tahun") }}">C</a></li>
                        <li><a class="dropdown-item" href="{{ url("/transaksi?area=d&status=$status&bulan=$bulan&tahun=$tahun") }}">D</a></li>
                        <li><a class="dropdown-item" href="{{ url("/transaksi?area=e&status=$status&bulan=$bulan&tahun=$tahun") }}">E</a></li>
                        <li><a class="dropdown-item" href="{{ url("/transaksi?area=f&status=$status&bulan=$bulan&tahun=$tahun") }}">F</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-md-12">
                <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#modalTambahTransaksi">Tambah Transaksi</button>
                <div class="modal fade" id="modalTambahTransaksi" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Menambah Transaksi</h5>
                                <span data-dismiss="modal" aria-label="Close"><i class="fa fa-circle-xmark" style="font-size:18px; cursor:pointer"></i></span>
                            </div>
                            <div class="modal-body">
                                <form method="POST" action="{{ url('/transaksi/admin/add') }}" enctype="multipart/form-data" id="file-upload-form" class="uploader">
                                    @csrf
                                    <div class="form-group">
                                        <label for="kode">Pilih Kode Rumah</label>
                                        <select class="form-select" name="kode" aria-label="Default select example">
                                            <option selected>Pilih Kode Rumah</option>
                                            @foreach ($all_users as $item)
                                                <option value="{{$item->kode}}">{{$item->kode}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="tgl_bayar">Tanggal Pembayaran</label>
                                        <input type="date" name="tgl_bayar" class="form-control" id="tgl_bayar" >
                                    </div>
                                    <input id="file-upload" type="file" name="bukti" accept="image/*" />
                                    
                                    <label for="file-upload" id="file-drag" class="label-upload">
                                        <img id="file-image" src="#" alt="Preview" class="hidden">
                                        <div id="start">
                                        <i class="fa fa-download" aria-hidden="true"></i>
                                        <div>Select a file or drag here</div>
                                        <div id="notimage" class="hidden">Please select an image</div>
                                        <span id="file-upload-btn" class="btn btn-primary">Select a file</span>
                                        </div>
                                        <div id="response" class="hidden">
                                        <div id="messages"></div>
                                        <progress class="progress" id="file-progress" value="0">
                                            <span>0</span>%
                                        </progress>
                                        </div>
                                    </label>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary " data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-success">Submit</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="table-responsive">
                <table class="table card-table table-vcenter text-nowrap datatable">
                    <thead>
                        <tr class="text-center">
                            <th scope="row">Nomor transaksi</th>
                            <th>Kode Rumah</th>
                            <th>Tgl Bayar</th>
                            <th>Bukti</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($datas) == 0)
                        <tr>
                            <td colspan="5" class="text-center">
                                <div class="m-3">
                                    <i class="fa fa-calendar-xmark mb-2" style="font-size:50px"></i><br>
                                    <span>Data Tidak Ditemukan</span>
                                </div>
                            </td>
                        </tr>
                        @endif

                        @foreach ($datas as $data)
                        <tr class="text-center">
                            <th class="align-middle" scope="row">{{ $data->id }}</th>
                            <td class="align-middle">{{ $data->kode_rumah}}</td>
                            <td class="align-middle">{{ $data->tgl_bayar}}</td>
                            <td class="align-middle">
                                <button class="btn btn-primary" data-toggle="modal" data-target="#modalbukti{{ $data->id }}">
                                    Lihat Bukti
                                </button>
                            </td>
                            <td class="align-middle">
                                @if ($data->status == 'pending')
                                    <span class="badge badge-warning">Pending</span>
                                @elseif($data->status == 'approve')
                                    <span class="badge badge-success">Approved</span>
                                @else
                                    <span class="badge badge-danger">Rejected</span>  
                                @endif    
                            </td>
                            <td class="align-middle">
                                @if ($data->status == 'pending')
                                    <div class="d-flex">
                                        <form action="{{ url('/transaksi/approve') }}" method="post">
                                            @csrf
                                            <input type="hidden" name="id" value="{{$data->id}}">
                                            <button type="submit" class="btn btn-success" >Approve</button>
                                        </form>
                                        <button class="btn btn-danger" style="margin-left: 9px" data-toggle="modal" data-target="#modalreject{{ $data->id }}">Rejected</button>
                                    </div>
                                @else
                                    -
                                @endif
                            </td>
                        </tr>

                        <div class="modal fade" id="modalreject{{ $data->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Reject Transaksi</h5>
                                        <span data-dismiss="modal" aria-label="Close"><i class="fa fa-circle-xmark" style="font-size:18px; cursor:pointer"></i></span>
                                    </div>
                                    <div class="modal-body">
                                        <form method="post" action="{{ url('/transaksi/reject') }}">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <input type="hidden" name="id" value="{{ $data->id }}">
                                            
                                            <div class="form-group">
                                                <label for="exampleFormControlTextarea1">Alasan</label>
                                                <textarea class="form-control" name="desc" id="exampleFormControlTextarea1" rows="3"></textarea>
                                            </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary " data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-success">Submit</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="modal fade" id="modalbukti{{ $data->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Lihat Bukti</h5>
                                        <span data-dismiss="modal" aria-label="Close"><i class="fa fa-circle-xmark" style="font-size:18px; cursor:pointer"></i></span>
                                    </div>
                                    <div class="modal-body">
                                        <img style="max-width: 100%" src="data:image/jpeg;base64,{{$data->bukti}}" alt="bukti" >
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary " data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
        <div class="d-flex justify-content-center mt-3">
            {!! $datas->links('pagination::bootstrap-4') !!}
        </div>
    </div>
</div>
@endsection

@section('js')
<script>

    // File Upload
    // 
    function ekUpload(){
    function Init() {

        console.log("Upload Initialised");

        var fileSelect    = document.getElementById('file-upload'),
            fileDrag      = document.getElementById('file-drag'),
            submitButton  = document.getElementById('submit-button');

        fileSelect.addEventListener('change', fileSelectHandler, false);

        // Is XHR2 available?
        var xhr = new XMLHttpRequest();
        if (xhr.upload) {
        // File Drop
        fileDrag.addEventListener('dragover', fileDragHover, false);
        fileDrag.addEventListener('dragleave', fileDragHover, false);
        fileDrag.addEventListener('drop', fileSelectHandler, false);
        }
    }

    function fileDragHover(e) {
        var fileDrag = document.getElementById('file-drag');

        e.stopPropagation();
        e.preventDefault();

        fileDrag.className = (e.type === 'dragover' ? 'hover' : 'modal-body file-upload');
    }

    function fileSelectHandler(e) {
        // Fetch FileList object
        var files = e.target.files || e.dataTransfer.files;

        // Cancel event and hover styling
        fileDragHover(e);

        // Process all File objects
        for (var i = 0, f; f = files[i]; i++) {
        parseFile(f);
        uploadFile(f);
        }
    }

    // Output
    function output(msg) {
        // Response
        var m = document.getElementById('messages');
        m.innerHTML = msg;
    }

    function parseFile(file) {

        console.log(file.name);
        output(
        '<strong>' + encodeURI(file.name) + '</strong>'
        );
        
        // var fileType = file.type;
        // console.log(fileType);
        var imageName = file.name;

        var isGood = (/\.(?=gif|jpg|png|jpeg)/gi).test(imageName);
        if (isGood) {
        document.getElementById('start').classList.add("hidden");
        document.getElementById('response').classList.remove("hidden");
        document.getElementById('notimage').classList.add("hidden");
        // Thumbnail Preview
        document.getElementById('file-image').classList.remove("hidden");
        document.getElementById('file-image').src = URL.createObjectURL(file);
        }
        else {
        document.getElementById('file-image').classList.add("hidden");
        document.getElementById('notimage').classList.remove("hidden");
        document.getElementById('start').classList.remove("hidden");
        document.getElementById('response').classList.add("hidden");
        document.getElementById("file-upload-form").reset();
        }
    }

    function setProgressMaxValue(e) {
        var pBar = document.getElementById('file-progress');

        if (e.lengthComputable) {
        pBar.max = e.total;
        }
    }

    function updateFileProgress(e) {
        var pBar = document.getElementById('file-progress');

        if (e.lengthComputable) {
        pBar.value = e.loaded;
        }
    }

    function uploadFile(file) {

        var xhr = new XMLHttpRequest(),
        fileInput = document.getElementById('class-roster-file'),
        pBar = document.getElementById('file-progress'),
        fileSizeLimit = 1024; // In MB
        if (xhr.upload) {
        // Check if file is less than x MB
        if (file.size <= fileSizeLimit * 1024 * 1024) {
            // Progress bar
            pBar.style.display = 'inline';
            xhr.upload.addEventListener('loadstart', setProgressMaxValue, false);
            xhr.upload.addEventListener('progress', updateFileProgress, false);

            // File received / failed
            xhr.onreadystatechange = function(e) {
            if (xhr.readyState == 4) {
                // Everything is good!

                // progress.className = (xhr.status == 200 ? "success" : "failure");
                // document.location.reload(true);
            }
            };

            // Start upload
            xhr.open('POST', document.getElementById('file-upload-form').action, true);
            xhr.setRequestHeader('X-File-Name', file.name);
            xhr.setRequestHeader('X-File-Size', file.size);
            xhr.setRequestHeader('Content-Type', 'multipart/form-data');
            xhr.send(file);
        } else {
            output('Please upload a smaller file (< ' + fileSizeLimit + ' MB).');
        }
        }
    }

    // Check for the various File API support.
    if (window.File && window.FileList && window.FileReader) {
        Init();
    } else {
        document.getElementById('file-drag').style.display = 'none';
    }
    }
    ekUpload();
    

</script>

@endsection