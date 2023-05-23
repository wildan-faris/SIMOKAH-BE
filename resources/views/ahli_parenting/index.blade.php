@extends('template.index')
@section('title', 'Ahli Parenting')
@section('content')
<div class="container">
    <h3 class="text-center text-secondary">DATA ahli-parenting</h3>
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
                <a type="button" class="btn btn-primary" href="/ahli-parenting/create/index">
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
                            <th>Email</th>
                            <th>Foto</th>
                            <th>Aksi</th>

                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $no =1;
                        @endphp
                        @foreach ($data_ahli_parenting as $dtap)
                        <tr class="text-center fw-normal">
                            <td>{{$no++}} </td>
                            <td>{{$dtap->name}}</td>

                            <td>{{$dtap->email}}</td>
                            <td class="col-3"><img width="50px" height="50px" src=" {{$dtap->photo_profil}}" alt=""></td>
                            <td>

                                <a href="" data-toggle="modal" data-target="#edit{{$dtap->id}}" class="btn btn-sm btn-warning"><i class="fas fa-edit text-white"></i></a>

                                <a href="/ahli-parenting/delete/{{$dtap->id}}" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></a>

                            </td>
                        </tr>


                        @endforeach
                    </tbody>

                </table>
            </div>
        </div>
    </div>

    <!-- modal edit data -->
    @foreach ($data_ahli_parenting as $dtap)
    <div class="modal fade" id="edit{{$dtap->id}}">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Form Edit Data</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="/ahli-parenting/edit" method="post">
                        @csrf
                        <input name="id" type="hidden" value="{{$dtap->id}}">
                        <div class="row mt-3">
                            <div class="col-2">
                                <label for="" class="form-label">Name</label>
                            </div>
                            <div class="col-8"><input value="{{$dtap->name}}" name="name" class="form-control" type="text" required></div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-2">
                                <label for="" class="form-label">Email</label>
                            </div>
                            <div class="col-8"><input value="{{$dtap->email}}" name="email" class="form-control" type="email" required></div>
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