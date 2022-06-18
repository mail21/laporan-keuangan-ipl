
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
        <div class="d-flex" style="gap: 10px;">
            {{-- filter montly --}}
            <div class="form-group">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                    {{$bulan ? 'Bulan - ' . $namaBulans[$bulan] : 'Pilih Bulan'}}
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                    @foreach ($namaBulans as $key => $item)
                        <li><a class="dropdown-item" href="{{ url('/dashboard?bulan='. $key . '&tahun='. $tahun ) }}">{{$item}}</a></li>
                    @endforeach
                </ul>
            </div>
            <div class="form-group">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                    {{$tahun ? 'Tahun - ' . $tahun : 'Pilih Tahun'}}
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
                    {{$status ? 'Status - ' . $status : 'Pilih Status'}}
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
                    {{$area ? 'Area - ' . $area : 'Pilih Area'}}
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
            <div class="form-group" >
                <button class="btn btn-primary" id="export-excel">Download Excel</button>
            </div>
        </div>
        
        <div class="table-responsive">
            <table id="tableHome" class="table">
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

@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.16.9/xlsx.full.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
<script>
    $(document).ready(function() {
        // var query_value_exercise;
        // $('#tableHome').on('search.dt', function() {
        //     var value = $('.dataTables_filter input').val();
        //     query_value_exercise = value
        // });
        // $('#tableAngsuran').DataTable({
        //     processing: true,
        //     serverSide: true,
        //     paging: true,
        //     ajax: "/get_angsuran",
        //     initComplete: function(settings, json) {
        //         console.log("pinjaman loaded")
        //     },
        //     // ordering: false,
        //     columns: [{
        //             data: "no_transaksi",
        //         },
        //         {
        //             data: "no_kta",
        //         },
        //         {
        //             data: "nama_anggota",
        //         },
        //         {
        //             data: "tgl_angsuran",
        //         },
        //         {
        //             data: "biaya_cicilan",
        //         },
        //         {
        //             data: "biaya_bunga",
        //         }, {
        //             data: null,
        //             render: function(data, type, row) {
        //                 // console.log(data, type, row)
        //                 return `<a class="btn btn-success" target="_blank" href="angsuran/${data.no_transaksi}">Cetak </a>`;
        //             }
        //         }
        //     ]
        // });
        // Export to excel

        const EXCEL_TYPE = 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet;charset=UTS-8'
        const EXCEL_EXTENSION = '.xlsx'

        let listData;
        let query_value = localStorage.getItem('key_list_exercise') ? localStorage.getItem('key_list_exercise') : '';

        function downloadAsExcel(data){
            const worksheet = XLSX.utils.json_to_sheet(data)
            const workbook = {
                Sheets: {
                    'data': worksheet
                },
                SheetNames: ['data']
            }
            const excelBuffer = XLSX.write(workbook, {bookType: 'xlsx', type: 'array'})
            // console.log(excelBuffer)
            saveAsExcel(excelBuffer, 'laporan_montly')
        }


        function saveAsExcel(buffer, filename){
            const data = new Blob([buffer], {type: EXCEL_TYPE});
            const namaFile = filename+'_export_'+(moment().format('yyyy MM DD hh mm ss')).replace(/\s/g, '')+EXCEL_EXTENSION;
            console.log(data)
            var link = document.createElement('a');
            link.href = window.URL.createObjectURL(data);
            link.download = namaFile;

            document.body.appendChild(link);

            link.click();
            document.body.removeChild(link);
            // saveAs(data, filename+'_export_'+(moment().format('yyyy MM DD hh mm ss')).replace(/\s/g, '')+EXCEL_EXTENSION)
        }

        $('#export-excel').on('click', function() {
            $.ajax({     
            type: "GET",
            data: {
                'bulan': "{{$bulan}}",
                'tahun': "{{$tahun}}",
                'area': "{{$area}}",
                'status': "{{$status}}",
            },
            url: '{!! URL::route("cetak.all") !!}',
            success: function (data) {
                downloadAsExcel(data)
            },
            dataType: "json"
            });
        });
    });
</script>
@endsection