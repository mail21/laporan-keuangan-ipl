
@extends('layouts.layout')

@section('css')
    <style>
        .dashboard__main{
            background: white;
            padding: 10px;
        }
    </style>
@endsection

@section('content-app')

    @php
        $namaBulans = array("01"=>"Januari", "02"=>"Februari", "03"=>"Maret", "04"=>"April", "05"=>"Mei", "06"=>"Juni", "07"=>"Juli", "08"=>"Agustus", "09"=>"September", "10"=>"Oktober", "11"=>"November", "12"=>"Desember");
    @endphp

    <div class="pagetitle">
    <h1>Dashboard</h1>
    </div><!-- End Page Title -->

    <main class="dashboard__main">
        <div>
            {{-- filter montly --}}
            <div class="form-group">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                    Pilih Bulan
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                    @foreach ($namaBulans as $key => $item)
                        <li><a class="dropdown-item" href="{{ url('/dashboard?bulan='. $key . '&tahun='. $tahun ) }}">{{$item}}</a></li>
                    @endforeach
                </ul>
            </div>
            <div class="form-group">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                    Pilih Tahun
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                    <li><a class="dropdown-item" href="{{ url('/dashboard?tahun='. '2022') }}">2022</a></li>
                    <li><a class="dropdown-item" href="{{ url('/dashboard?tahun='. '2023') }}">2023</a></li>
                    <li><a class="dropdown-item" href="{{ url('/dashboard?tahun='. '2024') }}">2024</a></li>
                </ul>
            </div>

            {{-- filter status --}}
            <div class="form-group">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                    Pilih Status
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                    <li><a class="dropdown-item" href="{{ url("/dashboard?status=all&bulan=$bulan&tahun=$tahun&area=$area") }}">All</a></li>
                    <li><a class="dropdown-item" href="{{ url("/dashboard?status=approve&bulan=$bulan&tahun=$tahun&area=$area") }}">Approve</a></li>
                    <li><a class="dropdown-item" href="{{ url("/dashboard?status=pending&bulan=$bulan&tahun=$tahun&area=$area") }}">Pending</a></li>
                    <li><a class="dropdown-item" href="{{ url("/dashboard?status=reject&bulan=$bulan&tahun=$tahun&area=$area") }}">Reject</a></li>
                    <li><a class="dropdown-item" href="{{ url("/dashboard?status=no&bulan=$bulan&tahun=$tahun&area=$area") }}">No Payment</a></li>
                </ul>
            </div>

            {{-- filter kode rumah --}}
            <div class="form-group">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                    Pilih Area
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                    <li><a class="dropdown-item" href="{{ url("/dashboard?area=all&status=$status&bulan=$bulan&tahun=$tahun") }}">All</a></li>
                    <li><a class="dropdown-item" href="{{ url("/dashboard?area=a&status=$status&bulan=$bulan&tahun=$tahun") }}">A</a></li>
                    <li><a class="dropdown-item" href="{{ url("/dashboard?area=b&status=$status&bulan=$bulan&tahun=$tahun") }}">B</a></li>
                    <li><a class="dropdown-item" href="{{ url("/dashboard?area=c&status=$status&bulan=$bulan&tahun=$tahun") }}">C</a></li>
                    <li><a class="dropdown-item" href="{{ url("/dashboard?area=d&status=$status&bulan=$bulan&tahun=$tahun") }}">D</a></li>
                    <li><a class="dropdown-item" href="{{ url("/dashboard?area=e&status=$status&bulan=$bulan&tahun=$tahun") }}">E</a></li>
                    <li><a class="dropdown-item" href="{{ url("/dashboard?area=f&status=$status&bulan=$bulan&tahun=$tahun") }}">F</a></li>
                </ul>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table">
                <thead class="thead-dark">
                  <tr>
                    <th scope="col">Kode Rumah</th>
                    <th scope="col">Status</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($datas as $data)
                      <tr>
                        <td>{{$data->kode}}</td>
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
                    @endforeach
                </tbody>
            </table>
        </div>
    </main>

@endsection