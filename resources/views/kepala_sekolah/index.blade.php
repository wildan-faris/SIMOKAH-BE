@extends('template.index')
@section('title', 'Kepala Sekolah')
@section('content')
<div class="container">
    <h3 class="text-center text-secondary">DATA KEPALA SEKOLAH </h3>
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
                @if ($len_kepala_sekolah === 0)
                <a type="button" class="btn btn-primary" href="/kepala-sekolah/create/index">
                    <i class="fas fa-user-plus"> </i> Tambah Data
                </a>
                @endif

            </div>

        </div>


        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped" id="example2">
                    <thead class="text-center">
                        <tr>

                            <th>Name</th>
                            <th>Email</th>
                            <th>Foto</th>
                            <th>Aksi</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data_kepala_sekolah as $dtks)



                        <tr class="text-center fw-normal">

                            <td>{{$dtks->name}}</td>

                            <td>{{$dtks->email}}</td>
                            <td class="col-3"><img width="50px" height="50px" src=" {{$dtks->photo_profil}}" alt=""></td>
                            <td>

                                <!-- <a href="" data-toggle="modal" data-target="#edit{{$dtks->id}}" class="btn btn-sm btn-warning"><i class="fas fa-edit text-white"></i></a> -->

                                <a href="/kepala-sekolah/delete/{{$dtks->id}}" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></a>

                            </td>
                        </tr>
                        @endforeach

                    </tbody>

                </table>
            </div>
        </div>
    </div>

    <!-- modal edit data -->


</div>
@endsection