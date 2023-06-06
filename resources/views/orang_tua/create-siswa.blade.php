@extends('template.index')
@section('title', 'orang_tua')
@section('content')
@foreach ($data_orang_tua as $dtot)



<div class="container">
    <h3 class="text-center text-secondary">TAMBAH DATA SISWA</h3>


    <div class="card  center-auto justify-content-center">
        <div class="card-header">
            <div class="text-right">
                <a href="/orang-tua/viewIndex/{{$dtot->id}}" class="btn btn-primary text-auto"><i class="fas fa-eye"></i> Lihat Data</a>
            </div>
        </div>
        <div class="card-body">
            <form action="/orang-tua/siswa/create" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="orang_tua_id" value="{{$dtot->id}}">
                <div class="row mt-3">
                    <div class="col-2">
                        <label for="" class="form-label">Name</label>
                    </div>
                    <div class="col-8"><input name="name" class="form-control" type="text" required></div>
                </div>
                <div class="row mt-3">
                    <div class="col-2">
                        <label for="" class="form-label">NIS</label>
                    </div>
                    <div class="col-8"><input name="nis" class="form-control" type="number" required></div>
                </div>
                <div class="row mt-3">
                    <div class="col-2">
                        <label for="" class="form-label">Tahun Ajaran</label>
                    </div>
                    <div class="col-8"><input name="tahun_ajaran" class="form-control" type="number" required></div>
                </div>

                <div class="row mt-3">
                    <div class="col-2">
                        <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                    </div>
                    <div class="col-8">
                        <select name="jenis_kelamin" id="jenis_kelamin" class="form-control" required>
                            <option value="" selected>-- Pilih Jenis Kelamin --</option>
                            <option value="laki-laki">laki-laki</option>
                            <option value="perempuan">perempuan</option>
                        </select>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-2">
                        <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
                    </div>
                    <div class="col-8">
                        <textarea name="tempat_lahir" id="tempat_lahir" class="form-control" cols="10" rows="2"></textarea>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-2">
                        <label for="" class="form-label">Tanggal Lahir</label>
                    </div>
                    <div class="col-8"><input name="tanggal_lahir" class="form-control" type="date" required></div>
                </div>
                <div class="row mt-3">
                    <div class="col-2">
                        <label for="jenis_kelamin" class="form-label">Kelas</label>
                    </div>
                    <div class="col-8">

                        <select name="kelas_id" id="kelas_id" class="form-control" required>
                            <option value="" selected>-- Pilih Kelas --</option>
                            @foreach ($data_kelas as $dtk)


                            <option value="{{$dtk->id}}">{{$dtk->name}}</option>

                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="mt-3 ml-auto ">
                    <input type="submit" class="btn btn-success" value="Tambah Data">
                </div>
            </form>
        </div>
    </div>

</div>




</div>
@endforeach
@endsection