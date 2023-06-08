@extends('template.index')
@section('title', 'orang_tua')
@section('content')
<div class="container">
    <h3 class="text-center text-secondary">DATA ORANG TUA</h3>
    @if ($messege = Session::get('success_delete'))
    <div class="alert alert-danger alert-dismissible " role="alert">
        <strong>{{$messege}}

    </div>
    @elseif ($messege= Session::get('success_create'))
    <div class="alert alert-success alert-dismissible " role="alert">
        <strong>{{$messege}}

    </div>
    @elseif ($messege= Session::get('failed_create'))
    <div class="alert alert-danger alert-dismissible " role="alert">
        <strong>{{$messege}}

    </div>
    @elseif ($messege= Session::get('success_edit'))
    <div class="alert alert-warning alert-dismissible text-white" role="alert">
        <strong>{{$messege}}

    </div>
    @elseif ($messege= Session::get('success_delete'))
    <div class="alert alert-danger alert-dismissible text-white" role="alert">
        <strong>{{$messege}}

    </div>
    @endif

    <div class="card">
        <div class="card-header">
            <div class="text-left">




            </div>

            <div class="text-right">
                <a type="button" class="btn btn-primary" href="/orang-tua/create/index">
                    <i class="fas fa-user-plus"> </i> Tambah Data
                </a>
            </div>

        </div>


        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped" id="example2">
                    <thead class="text-center">
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Foto</th>
                            <th>Aksi</th>

                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $no =1;
                        @endphp
                        @foreach ($data_orang_tua as $dtot)
                        <tr class="text-center fw-normal">
                            <td>{{$no++}} </td>
                            <td>{{$dtot->name}}</td>
                            <td>{{$dtot->username}}</td>
                            <td>{{$dtot->email}}</td>
                            <td class="col-3"><img width="50px" height="50px" src=" {{$dtot->photo_profil}}" alt=""></td>
                            <td>

                                <a href="/orang-tua/viewIndex/{{$dtot->id}}" class="btn btn-sm btn-primary"><i class="fas fa-users text-white"></i></a>
                                <a href="/orang-tua/edit/index/{{$dtot->id}}" class="btn btn-sm btn-warning"><i class="fas fa-edit text-white"></i></a>

                                <a href="/orang-tua/delete/{{$dtot->id}}" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></a>

                            </td>
                        </tr>


                        @endforeach
                    </tbody>

                </table>
            </div>
        </div>
    </div>

    <!-- modal edit data -->
    @foreach ($data_orang_tua as $dtot)
    <div class="modal fade" id="edit{{$dtot->id}}">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Form Edit Data</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="/orang_tua/edit" method="post">
                        @csrf
                        <input name="id" type="hidden" value="{{$dtot->id}}">
                        <div class="row mt-3">
                            <div class="col-2">
                                <label for="" class="form-label">Name</label>
                            </div>
                            <div class="col-8"><input value="{{$dtot->name}}" name="name" class="form-control" type="text" required></div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-2">
                                <label for="" class="form-label">Email</label>
                            </div>
                            <div class="col-8"><input value="{{$dtot->email}}" name="email" class="form-control" type="email" required></div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-2">
                                <label for="" class="form-label">Username</label>
                            </div>
                            <div class="col-8"><input value="{{$dtot->username}}" name="username" class="form-control" type="text" required></div>
                        </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-warning text-white">Edit Data</button>
                </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    @endforeach

</div>
@endsection