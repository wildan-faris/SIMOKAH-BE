@extends('template.index')
@section('title', 'Guru')
@section('content')

<div class="container">
    <h3 class="text-center text-secondary">TAMBAH DATA GURU</h3>


    <div class="card  center-auto justify-content-center">
        <div class="card-header">
            <div class="text-right">
                <a href="/guru/index" class="btn btn-primary text-auto"><i class="fas fa-eye"></i> Lihat Data</a>
            </div>
        </div>
        <div class="card-body">
            <form action="/guru/create" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row mt-3">
                    <div class="col-2">
                        <label for="" class="form-label">Name</label>
                    </div>
                    <div class="col-8"><input name="name" class="form-control" type="text" required></div>
                </div>
                <div class="row mt-3">
                    <div class="col-2">
                        <label for="" class="form-label">Email</label>
                    </div>
                    <div class="col-8"><input name="email" class="form-control" type="email" required></div>
                </div>
                <div class="row mt-3">
                    <div class="col-2">
                        <label for="" class="form-label">Username</label>
                    </div>
                    <div class="col-8"><input name="username" class="form-control" type="text" required></div>
                </div>
                <div class="row mt-3">
                    <div class="col-2">
                        <label for="" class="form-label">Password</label>
                    </div>
                    <div class="col-8"><input name="password" class="form-control" type="password" required></div>
                </div>


                <div class="mt-3 ml-auto ">
                    <input type="submit" class="btn btn-success" value="Tambah Data">
                </div>
            </form>
        </div>
    </div>

</div>




</div>
@endsection