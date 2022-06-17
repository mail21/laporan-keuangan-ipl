
@extends('layouts.layout')


@section('content-app')
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
            <div class="col-md-2">
                <div class="form-group">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                        Pilih Bulan
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                        <li><a class="dropdown-item" href="{{ url('/transaksi?bulan='. 'januari2022') }}">Januari 2022</a></li>
                        <li><a class="dropdown-item" href="{{ url('/transaksi?bulan='. 'januari2022') }}">Januari 2022</a></li>
                        <li><a class="dropdown-item" href="{{ url('/transaksi?bulan='. 'januari2022') }}">Januari 2022</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                        Pilih Status
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                        <li><a class="dropdown-item" href="{{ url('/transaksi?status='. 'Approve') }}">Approve</a></li>
                        <li><a class="dropdown-item" href="{{ url('/transaksi?status='. 'Pending') }}">Pending</a></li>
                        <li><a class="dropdown-item" href="{{ url('/transaksi?status='. 'Reject') }}">Reject</a></li>
                    </ul>
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