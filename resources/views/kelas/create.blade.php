@extends('template.index')
@section('title', 'Kelas')
@section('content')



<div class="container">
    <h3 class="text-center text-secondary">TAMBAH DATA KELAS</h3>


    <div class="card  center-auto justify-content-center">
        <div class="card-header">
            <div class="text-right">
                <a href="/kelas/index" class="btn btn-primary text-auto"><i class="fas fa-eye"></i> Lihat Data</a>
            </div>
        </div>
        <div class="card-body">
            <form action="/kelas/create" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row mt-3">
                    <div class="col-2">
                        <label for="" class="form-label">Name</label>
                    </div>
                    <div class="col-8"><input name="name" class="form-control" type="text" required></div>
                </div>
                <div class="row mt-3">
                    <div class="col-2">
                        <label for="" class="form-label">Guru</label>
                    </div>
                    <div class="col-8">
                        <select name="guru_id" id="guru_id" class="form-control m">
                            @foreach ($data_guru as $dtg)
                            <option value="{{$dtg->id}}">{{$dtg->name}}</option>
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
@endsection