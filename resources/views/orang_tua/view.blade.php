@extends('template.index')
@section('title', 'orang_tua')
@section('content')
@foreach ($data_orang_tua as $dtot)
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
            <div class="text-right">
                <a type="button" class="btn btn-primary" href="/orang-tua/siswa/create/index/{{$dtot->id}}">
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
                            <th>NIS</th>
                            <th>Tahun Ajaran</th>
                            <th>Kelas</th>
                            <th>Aksi</th>

                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $no =1;
                        @endphp
                        @foreach ($dtot->siswa as $dts)


                        <tr class="text-center fw-normal">
                            <td>{{$no++}} </td>
                            <td>{{$dts->name}}</td>
                            <td>{{$dts->nis}}</td>
                            <td>{{$dts->tahun_ajaran}}</td>
                            <td>{{$dts->kelas->name}}</td>

                            <td>


                                <a href="/siswa/delete/{{$dts->id}}" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></a>
                                <a href="/orang-tua/siswa/edit/index/{{$dts->id}}" class="btn btn-sm btn-warning text-white"><i class="fas fa-edit"></i></a>

                            </td>
                        </tr>

                        @endforeach

                    </tbody>

                </table>
            </div>
        </div>
    </div>



    @endforeach
</div>
@endsection