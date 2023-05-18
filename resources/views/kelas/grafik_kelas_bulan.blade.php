@extends('template.index')

@section('content')
<div class="container">
    <h3 class="text-center text-secondary">DATA GRAFIK {{strtoupper($data_kelas->name)}}</h3>
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
    @foreach ($data_total_nilai_kelas_bulan as $dtnkb)
    <div class="card">
        <div class="card-header row">
            <div class="text-left mr-2">
                <h2>{{$dtnkb->bulan}}</h2>
            </div>
            <div class="text-right">
                <h2>{{$dtnkb->tahun}}</h2>
            </div>
        </div>



        @foreach ($data_aktivitas as $dta)
        <div class="card-body">
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title">

                        <i class="far fa-chart-bar"></i>
                        {{$dta->name}}
                    </h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">

                    <div class="col">


                        @foreach ($dta->sub_aktivitas as $dtasb)


                        <div class="row align-items-end mb-3">
                            <div class="col-md-2">
                                {{$dtasb->name}}
                            </div>
                            <div class="col-md-10">
                                @foreach ($dtnkb->total_nilai_kelas_bulan as $dttnk)
                                @if ($dttnk->kelas_id == $data_kelas->id)
                                @if ($dttnk->sub_aktivitas_id == $dtasb->id)

                                {{$dttnk->nilai}}
                                @php
                                $grafik = $dttnk->nilai * 20;
                                @endphp
                                <div class="" style="width: {{$grafik}}%; height:20px; background-color:#05BFDB;"></div>



                                @endif
                                @endif
                                @endforeach

                            </div>
                        </div>
                        @endforeach

                    </div>



                </div>
            </div>
        </div>
        @endforeach



    </div>
    @endforeach
    @section('scripts')

    @endsection
    @endsection