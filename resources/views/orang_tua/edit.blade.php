@extends('template.index')
@section('title', 'orang_tua')
@section('content')
@foreach ($data_orang_tua as $dtot)


<div class="container">
    <h3 class="text-center text-secondary">TAMBAH DATA ORANG TUA</h3>


    <div class="card  center-auto justify-content-center">
        <div class="card-header">
            <div class="text-right">
                <a href="/orang-tua/index" class="btn btn-primary text-auto"><i class="fas fa-eye"></i> Lihat Data</a>
            </div>
        </div>
        <div class="card-body">
            <form action="/orang-tua/edit" method="post" enctype="multipart/form-data">
                @csrf

                <input type="hidden" name="id" value="{{$dtot->id}}">
                <div class="row mt-3">
                    <div class="col-2">
                        <label for="" class="form-label">Name</label>
                    </div>
                    <div class="col-8"><input name="name" value="{{$dtot->name}}" class="form-control" type="text" required></div>
                </div>
                <div class="row mt-3">
                    <div class="col-2">
                        <label for="" class="form-label">Username</label>
                    </div>
                    <div class="col-8"><input name="username" value="{{$dtot->username}}" class="form-control" type="text" required></div>
                </div>
                <div class="row mt-3">
                    <div class="col-2">
                        <label for="" class="form-label">Email</label>
                    </div>
                    <div class="col-8"><input name="email" value="{{$dtot->email}}" class="form-control" type="email" required></div>
                </div>

                <div class="row mt-3">
                    <div class="col-2">
                        <label for="" class="form-label">Pekerjaan</label>
                    </div>
                    <div class="col-8"><input name="pekerjaan" value="{{$dtot->pekerjaan}}" class="form-control" type="text" required></div>
                </div>
                <div class="row mt-3">
                    <div class="col-2">
                        <label for="alamat" class="form-label">Alamat</label>
                    </div>
                    <div class="col-8">
                        <textarea name="alamat" id="alamat" class="form-control" cols="10" rows="5">{{$dtot->alamat}}</textarea>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-2">
                        <label for="" class="form-label">No HP</label>
                    </div>
                    <div class="col-8"><input name="no_hp" value="{{$dtot->no_hp}}" class="form-control" type="text" required></div>
                </div>

                <div class="mt-3 ml-auto ">
                    <input type="submit" class="btn btn-success fw-bold" value="Ubah Data">
                </div>
            </form>
        </div>
    </div>

</div>




</div>
@endforeach
@endsection