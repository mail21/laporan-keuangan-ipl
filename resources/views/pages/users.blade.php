
@extends('layouts.layout')


@section('content-app')
<h2 class="mt-2 mb-5">Master User</h2>
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
        </div>
        <div class="row mb-3">
            <button class="btn btn-success" type="button" data-toggle="modal" data-target="#modalTambahAngsuran">Tambah Users</button>

            <div class="modal fade" id="modalTambahAngsuran" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Menambah Users</h5>
                            <span data-dismiss="modal" aria-label="Close"><i class="fa fa-circle-xmark" style="font-size:18px; cursor:pointer"></i></span>
                        </div>
                        <div class="modal-body">
                            <form method="post" action="{{ url('/users/add') }}">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Kode Rumah</label>
                                    <input type="text" name="kode" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Kode">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Nama Users</label>
                                    <input type="text" name="nama" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter nama">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">email</label>
                                    <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">nomor_hp</label>
                                    <input type="text" name="nomor_hp" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter nomor hp">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Role</label>
                                    <select class="form-select" name="role" required>
                                        <option value="admin">Admin</option>
                                        <option value="superadmin">Super Admin</option>
                                        <option value="user">User</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">password</label>
                                    <input type="password" name="password" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter stok">
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
        </div>
        <div class="card">
            <div class="table-responsive">
                <table class="table card-table table-vcenter text-nowrap">
                    <thead>
                        <tr class="text-center">
                            <th scope="row">Kode</th>
                            <th>Nama Users</th>
                            <th>email</th>
                            <th>nomor_hp</th>
                            <th>role</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($users) == 0)
                        <tr>
                            <td colspan="5" class="text-center">
                                <div class="m-3">
                                    <i class="fa fa-calendar-xmark mb-2" style="font-size:50px"></i><br>
                                    <span>Data Tidak Ditemukan</span>
                                </div>
                            </td>
                        </tr>
                        @endif

                        @foreach ($users as $data)
                        <tr class="text-center">
                            <th class="align-middle" scope="row">{{ $data->kode }}</th>
                            <td class="align-middle">{{ $data->nama}}</td>
                            <td class="align-middle">{{ $data->email}}</td>
                            <td class="align-middle">{{ $data->nomor_hp}}</td>
                            <td class="align-middle">{{ $data->role}}</td>
                            <td class="align-middle">
                                <div>
                                    <button class="btn btn-warning" data-toggle="modal" data-target="#modaledit{{ $data->kode }}">Edit</button>
                                    <button class="btn btn-danger" data-toggle="modal" data-target="#modalhapus{{ $data->kode }}">Delete</button>
                                </div>
                            </td>
                        </tr>

                        <div class="modal fade" id="modalhapus{{ $data->kode }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Hapus Users</h5>
                                        <span data-dismiss="modal" aria-label="Close"><i class="fa fa-circle-xmark" style="font-size:18px; cursor:pointer"></i></span>
                                    </div>
                                    <div class="modal-body">
                                        <form method="post" action="{{ url('/users/hapus') }}">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <input type="hidden" name="kode" value="{{ $data->kode }}">
                                            
                                        <p>Anda Yakin ingin menghapus user {{$data->nama}}?</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary " data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-success">Submit</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="modal fade" id="modaledit{{ $data->kode }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Edit Users</h5>
                                        <span data-dismiss="modal" aria-label="Close"><i class="fa fa-circle-xmark" style="font-size:18px; cursor:pointer"></i></span>
                                    </div>
                                    <div class="modal-body">
                                        <form method="post" action="{{ url('/users/edit') }}">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Kode Users</label>
                                                <input type="text" name="kode" value="{{$data->kode}}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Kode">
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Nama Users</label>
                                                <input type="text" name="nama" value="{{$data->nama}}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter nama">
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">email</label>
                                                <input type="email" name="email" value="{{$data->email}}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">nomor_hp</label>
                                                <input type="text" name="nomor_hp" value="{{$data->nomor_hp}}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter no hp">
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Role</label>
                                                <select class="form-select" name="role" required>
                                                    <option value="admin" {{$data->role == 'admin' ? 'selected' : ''}}>Admin</option>
                                                    <option value="superadmin" {{$data->role == 'superadmin' ? 'selected' : ''}}>Super Admin</option>
                                                    <option value="user" {{$data->role == 'user' ? 'selected' : ''}}>User</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">password</label>
                                                <input type="password" name="password" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter stok">
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
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
        <div class="d-flex justify-content-center mt-3">
            {!! $users->links('pagination::bootstrap-4') !!}
        </div>
    </div>
</div>
@endsection