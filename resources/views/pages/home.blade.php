
@extends('layouts.home-layout')


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
            
            <div class="card body-form">
                <div class="card-header">
                    <h4 class="card-title">Status</h4>
                </div class="card-content">
                    <div class="card-body">
                          @if (!empty($latestTransaksi))
                            @if (date('m',strtotime($latestTransaksi->tgl_bayar)) == date('m'))
                                <div>
                                    @if ($latestTransaksi->status == 'pending')
                                        <span class="badge badge-warning">Pending</span>
                                    @elseif($latestTransaksi->status == 'approve')
                                        <span class="badge badge-success">Approved</span>
                                    @else
                                        <span class="badge badge-danger">Rejected</span>  
                                    @endif   

                                    {{$latestTransaksi->desc}}

                                    <div class="row mb-3">
                                        <button class="btn btn-info col-md-5 mx-auto  mt-5" type="button" data-toggle="modal" data-target="#modallihatTransaksi">Lihat Bukti</button>
                                        <button class="btn btn-warning col-md-5 mx-auto  mt-5" type="button" data-toggle="modal" data-target="#modalTambahTransaksi">Reupload Bukti</button>
                                    </div>
                                </div>
                                <div class="modal fade" id="modallihatTransaksi" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Lihat Transaksi</h5>
                                                <span data-dismiss="modal" aria-label="Close"><i class="fa fa-circle-xmark" style="font-size:18px; cursor:pointer"></i></span>
                                            </div>
                                            <div class="modal-body">
                                                <img src="data:image/jpeg;base64,{{$latestTransaksi->bukti}}" alt="asd" >
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary text-dark" data-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <span class="badge badge-dark text-capitalize">
                                    no payment
                                </span>
                                <p>Belum ada pembayaran bulan ini</p>
                                <button class="btn btn-info w-100" type="button" data-toggle="modal" data-target="#modalTambahTransaksi">Upload Bukti</button>
                            @endif
                          @else
                            <span class="badge badge-dark text-capitalize">
                                no payment
                            </span>
                            <p>Belum ada pembayaran bulan ini</p>
                            <button class="btn btn-info w-100" type="button" data-toggle="modal" data-target="#modalTambahTransaksi">Upload Bukti</button>
                          @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">History Transaksi</h4>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <div class="row">
                            @foreach ($historyTransaksi as $data)
                            <div class="col-md-6">
                                <div class="list-group mb-2">
                                    <span class="list-group-item list-group-item-action">
                                        <div class="d-flex w-100 justify-content-between">
                                            <h5 class="mb-1">ID Transaksi : {{$data->id}}</h5>
                                            {{-- <small class="text-right">asdasd</small> --}}
                                        </div>
                                        <table class="mb-1">
                                            <tr>
                                                <td>Tanggal Bayar</td>
                                                <td>:</td>
                                                <td>
                                                    {{date_format(date_create($data->tgl_bayar)," m - Y H:i")}}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Status </td>
                                                <td>:</td>
                                                <td>
                                                    @if ($data->status)
                                                        @if ($data->status == 'pending')
                                                            <span class="badge badge-warning">Pending</span>
                                                        @elseif($data->status == 'approve')
                                                            <span class="badge badge-success">Approved</span>
                                                        @else
                                                            <span class="badge badge-danger">Rejected</span>  
                                                        @endif    
                                                    @else
                                                        <span class="badge badge-dark">No Payment</span>
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Keterangan</td>
                                                <td>:</td>
                                                <td>
                                                    {{$data->desc}}
                                                </td>
                                            </tr>
                                        </table>
                                    </span>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <div class="d-flex justify-content-center mt-3">
                            {!! $historyTransaksi->links('pagination::bootstrap-4') !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modalTambahTransaksi" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Menambah Transaksi</h5>
                    <span data-dismiss="modal" aria-label="Close"><i class="fa fa-circle-xmark" style="font-size:18px; cursor:pointer"></i></span>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ url('/transaksi/add') }}" enctype="multipart/form-data" id="file-upload-form" class="uploader">
                        @csrf
                        <input type="hidden" name="kode" value="{{Auth::user()->kode}}">
                        @if (!empty($latestTransaksi))
                            @if (date('m',strtotime($latestTransaksi->tgl_bayar)) == date('m'))
                                <input type="hidden" name="id" value="{{$latestTransaksi->id}}">
                                <input type="hidden" name="tgl_bayar" value="{{$latestTransaksi->tgl_bayar}}">
                            @else
                                <div class="form-group">
                                    <label for="tgl_bayar">Tanggal Pembayaran</label>
                                    <input type="date" name="tgl_bayar" class="form-control" id="tgl_bayar" >
                                </div>
                            @endif
                        @else
                            <div class="form-group">
                                <label for="tgl_bayar">Tanggal Pembayaran</label>
                                <input type="date" name="tgl_bayar" class="form-control" id="tgl_bayar" >
                            </div>
                        @endif
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
                    <button type="button" class="btn btn-secondary text-dark" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection()

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