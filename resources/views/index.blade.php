@extends('template.index')
@section('title', 'Beranda')
@section('content')
<div class="container">

    <section class="content">
        <div class="container-fluid">
            <h5 class="mb-2">Info Box</h5>
            <div class="row">
                <div class="col-md-3 col-sm-6 col-12">
                    <a href="/guru/index">
                        <div class="info-box">
                            <span class="info-box-icon bg-info"><i class="fas fa-users"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text text-dark">Data Guru</span>
                                <span class="info-box-number text-dark">{{$data_guru}}</span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                    </a>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-md-3 col-sm-6 col-12">
                    <a href="/kelas/index">
                        <div class="info-box">
                            <span class="info-box-icon bg-success"><i class="fas fa-chalkboard-teacher"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text text-dark">Data Kelas</span>
                                <span class="info-box-number text-dark">{{$data_kelas}}</span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                    </a>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-md-3 col-sm-6 col-12">
                    <a href="/aktivitas/index">
                        <div class="info-box">
                            <span class="info-box-icon bg-warning"><i class="fas fa-running"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text text-dark">Data Aktivitas</span>
                                <span class="info-box-number text-dark">{{$data_aktivitas}}</span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                    </a>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->

            </div>
            <!-- /.row -->

        </div>

        @endsection