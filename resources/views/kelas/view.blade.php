@extends('template.index')

@section('content')
<div class="container">
    <h3 class="text-center text-secondary">DATA {{strtoupper($data_kelas->name)}}</h3>
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

    <div class="card">
        <div class="card-header">
            <div class="text-left">




            </div>

            <div class="text-right">
                <a type="button" class="btn btn-primary" href="/kelas/grafik/kelas/{{$data_kelas->id}}">
                    <i class="fas fa-chart-pie"></i> Data Grafik Kelas
                </a>
                <a type="button" class="btn btn-primary" href="/kelas/grafik/kelas/bulan/{{$data_kelas->id}}">
                    <i class="fas fa-chart-pie"></i> Data Grafik Bulanan Kelas
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
                        @foreach ($data_siswa as $dts)
                        <tr class="text-center fw-normal">
                            <td>{{$no++}} </td>
                            <td>{{$dts->name}}</td>

                            <td>
                                <a href="/kelas/grafik/siswa/{{$dts->id}}" class="btn btn-sm btn-primary"><i class="fas fa-chart-pie text-white"></i></a>


                            </td>
                        </tr>


                        @endforeach
                    </tbody>

                </table>
            </div>
        </div>
    </div>



</div>
@endsection