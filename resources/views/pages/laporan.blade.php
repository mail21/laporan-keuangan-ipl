
@extends('layouts.layout')


@section('content-app')
<h2 class="mt-2 mb-5">Transaksi</h2>
<div class="row row-cards">
    <div class="col-12">
        {{-- <div class="row mb-3">
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
                    <a class="btn btn-success" target="_blank" href="/master/rekap/angsuran/{{$arr->no_transaksi}}">Cetak Kwitansi</a> 
                </div>
                @endif
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <button class="btn btn-secondary text-dark dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                        Pilih Anggota
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                        @foreach ($anggotas as $anggota)
                        <li><a class="dropdown-item" href="{{ url('/angsuran?no_kta='.$anggota->no_kta) }}">{{ $anggota->nama_anggota }}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="col-md-5"></div>
            <div class="col-md-3 text-right">
                @if (!$isSudahLunas)
                <button class="btn btn-success" type="button" data-toggle="modal" data-target="#modalTambahAngsuran">Tambah Angsuran</button>
                @endif
            </div>
            <div class="col-md-4">
                <div class="form-group text-center">
                    <div class="form-control" id="basicInput"><label for="basicInput">Nomor KTA : {{$no_kta}}</label></div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group text-center">
                    <div class="form-control" id="basicInput"><label for="basicInput">Nomor Transaksi : {{$no_transaksi}}</label></div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    @if ($isSudahLunas)
                    <div class="form-control border border-success text-center" id="basicInput"><label class="text-success">Pinjaman Sudah Lunas</label></div>
                    @else
                    <div class="form-control" id="basicInput"><label for="basicInput">Sisa {{$jmlCicilan}} Angsuran</label></div>
                    @endif
                </div>
            </div>
            <div class="modal fade" id="modalTambahAngsuran" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Menambah Angsuran Pinjaman</h5>
                            <span data-dismiss="modal" aria-label="Close"><i class="fa fa-circle-xmark" style="font-size:18px; cursor:pointer"></i></span>
                        </div>
                        <div class="modal-body">
                            <form method="post" action="{{ url('/angsuran/add') }}">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <table>
                                    <tr>
                                        <td><span>Tagihan Cicilan</span></td>
                                        <td> : </td>
                                        <td><span>{{$Helper->revertMoney($Pokokpinjamanperbulan)}}</span></td>
                                    </tr>
                                    <tr>
                                        <td><span>Bunga Cicilan</span></td>
                                        <td> : </td>
                                        <td><span>{{$Helper->revertMoney($Bungaperbulan)}}</span></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <hr>
                                        </td>
                                        <td>
                                            <hr>
                                        </td>
                                        <td>
                                            <hr>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><span>Total</span></td>
                                        <td> : </td>
                                        <td><span>{{$Helper->revertMoney($cicilan)}}</span></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <hr>
                                        </td>
                                        <td>
                                            <hr>
                                        </td>
                                        <td>
                                            <hr>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><span>Simpanan Anda</span></td>
                                        <td> : </td>
                                        <td><span>{{$totalSimpanan}}</span></td>
                                    </tr>
                                </table>
                                <div>
                                    <input class="m-2" type="checkbox" name="isChecked" id="flexCheckChecked">
                                    <label class="form-check-label" for="flexCheckChecked">
                                        Pakai Uang Simpanan?
                                    </label>
                                </div>
                                <input type="hidden" name="no_kta" value="{{ $no_kta }}">
                                <input type="hidden" name="no_transaksi_pinjaman" value="{{ $no_transaksi }}">
                                <input type="hidden" name="biaya_cicilan" value="{{ $Pokokpinjamanperbulan }}">
                                <input type="hidden" name="biaya_bunga" value="{{ $Bungaperbulan }}">
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
        <div class="row mb-3">
            <div class="dropdown">
                <button class="btn btn-secondary text-dark dropdown-toggle" type="button" id="dropdownMenuButton2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Filter Tanggal Angsuran
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
                    <a class="dropdown-item" href="/angsuran?order=asc{{ $no_kta ? $no_transaksi ? '&no_kta=' . $no_kta . '&no_transaksi=' . $no_transaksi : '&no_kta=' . $no_kta : '' }}">Terbaru</a>
                    <a class="dropdown-item" href="/angsuran?order=desc{{ $no_kta ? $no_transaksi ? '&no_kta=' . $no_kta . '&no_transaksi=' . $no_transaksi : '&no_kta=' . $no_kta : '' }}">Terlama</a>
                </div>
            </div>
        </div> --}}
        <div class="card">
            <div class="table-responsive">
                <table class="table card-table table-vcenter text-nowrap datatable">
                    <thead>
                        <tr class="text-center">
                            <th scope="row">Nomor transaksi</th>
                            <th>Kode Rumah</th>
                            <th>Biaya Cicilan</th>
                            <th>Tanggal Bayar</th>
                            <th>Biaya</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- @if (count($angsurans) == 0)
                        <tr>
                            <td colspan="5" class="text-center">
                                <div class="m-3">
                                    <i class="fa fa-calendar-xmark mb-2" style="font-size:50px"></i><br>
                                    <span>Data Tidak Ditemukan</span>
                                </div>
                            </td>
                        </tr>
                        @endif --}}

                        {{-- @foreach ($angsurans as $data)
                        <tr class="text-center">
                            <th class="align-middle" scope="row">{{ $data->no_transaksi }}</th>
                            <td class="align-middle">{{ $data->tgl_angsuran}}</td>
                            <td class="align-middle">{{ $Helper->revertMoney($data->biaya_cicilan) }}</td>
                            <td class="align-middle">{{ $Helper->revertMoney($data->biaya_bunga) }}</td>
                            <td class="align-middle">{{ $Helper->revertMoney($data->biaya_cicilan+$data->biaya_bunga) }}</td>
                        </tr>
                        @endforeach --}}
                    </tbody>
                </table>
            </div>

        </div>
        <div class="d-flex justify-content-center mt-3">
            {{-- {!! $angsurans->links('pagination::bootstrap-4') !!} --}}
        </div>
    </div>
</div>
@endsection