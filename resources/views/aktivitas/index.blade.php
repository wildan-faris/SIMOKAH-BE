@extends('template.index')
@section('title', 'Aktivitas')
@section('content')
<div class="container">
    <h3 class="text-center text-secondary">DATA AKTIVITAS</h3>
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
                <a type="button" class="btn btn-primary" href="/aktivitas/create/index">
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
                        @foreach ($data_aktivitas as $dta)
                        <tr class="text-center fw-normal">
                            <td>{{$no++}} </td>
                            <td>{{$dta->name}}</td>

                            <td>
                                <a href="/sub-aktivitas/index/{{$dta->id}}" class="btn btn-sm btn-primary"><i class="fas fa-table-tennis"></i></a>
                                <a href="" data-toggle="modal" data-target="#edit{{$dta->id}}" class="btn btn-sm btn-warning"><i class="fas fa-edit text-white"></i></a>
                                <a href="/aktivitas/delete/{{$dta->id}}" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></a>

                            </td>
                        </tr>


                        @endforeach
                    </tbody>

                </table>
            </div>
        </div>
    </div>

    <!-- modal edit data -->
    @foreach ($data_aktivitas as $dta)
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
                    <form action="/aktivitas/edit" method="post">
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
    @else
    @endif


    <!-- session untuk kepala sekolah -->
    @if (session()->get("role") == "kepala sekolah")


    <div class="row">
        @foreach ($data_aktivitas as $dta)


        <div class="col-md-3 col-sm-6 col-12">
            <a href="/aktivitas/view/{{$dta->id}}">
                <div class="info-box">
                    <span class="info-box-icon bg-info"><i class="nav-icon fas fa-users"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">{{$dta->name}}</span>
                        <span class="info-box-number">{{count($dta->siswa)}} Siswa</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </a>
        </div>

        @endforeach
    </div>
    @endif
    <!-- end session untuk kepala sekolah -->

</div>
@endsection