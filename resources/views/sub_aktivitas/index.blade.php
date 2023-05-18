@extends('template.index')

@section('content')
<div class="container">
    <h3 class="text-center text-secondary">DATA SUB AKTIVITAS</h3>
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

    <!-- session untuk admin -->
    @if (session()->get("role") == "admin")
    <div class="card">
        <div class="card-header">
            <div class="text-left">




            </div>

            <div class="text-right">
                <a href="" data-toggle="modal" data-target="#create" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Tambah Data
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
                            <th>Aksi</th>

                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $no =1;
                        @endphp
                        @foreach ($data_sub_aktivitas as $dta)
                        <tr class="text-center fw-normal">
                            <td>{{$no++}} </td>
                            <td>{{$dta->name}}</td>

                            <td>

                                <a href="" data-toggle="modal" data-target="#edit{{$dta->id}}" class="btn btn-sm btn-warning"><i class="fas fa-edit text-white"></i></a>


                                <a href="/sub-aktivitas/delete/{{$dta->id}}" onclick="confirm('Apakah Anda yakin ingin menghapus data ini?')" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></a>

                            </td>
                        </tr>


                        @endforeach
                    </tbody>

                </table>
            </div>
        </div>
    </div>

    <!-- modal delete data -->
    @foreach ($data_sub_aktivitas as $dta)
    <div class="modal fade" id="delete{{$dta->id}}">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Apakah Anda Yakin Akan Menghapus Data?</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-warning text-white">Edit Data</button>
                </div>

            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    @endforeach




    <!-- modal edit data -->
    @foreach ($data_sub_aktivitas as $dta)
    <div class="modal fade" id="edit{{$dta->id}}">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Form Edit Data</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="/sub-aktivitas/edit" method="post">
                        @csrf
                        <input name="id" type="hidden" value="{{$dta->id}}">
                        <div class="row mt-3">
                            <div class="col-2">
                                <label for="" class="form-label">Name</label>
                            </div>
                            <div class="col-8"><input value="{{$dta->name}}" name="name" class="form-control" type="text" required></div>
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

    <!--  end session untuk admin -->


    <!-- modal tambah data -->

    <div class="modal fade" id="create">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Form Tambah Data</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="/sub-aktivitas/create" method="post">
                        @csrf
                        <input name="id" type="hidden" value="">
                        <div class="row mt-3">
                            <div class="col-2">
                                <label for="" class="form-label">Name</label>
                            </div>
                            <div class="col-8"><input name="name" class="form-control" type="text" required></div>
                        </div>
                        <input type="hidden" value="{{$aktivitas_id}}" name="aktivitas_id">

                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary text-white">Tambah Data</button>
                </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    <!--  end session untuk admin -->
    @else
    @endif




</div>
@endsection