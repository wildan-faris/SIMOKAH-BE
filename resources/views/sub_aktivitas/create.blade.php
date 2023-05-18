@extends('template.index')

@section('content')



<div class="container">
    <h3 class="text-center text-secondary">TAMBAH DATA SUB AKTIVITAS</h3>


    <div class="card  center-auto justify-content-center">
        <div class="card-header">
            <div class="text-right">
                <a href="/sub-aktivitas/index" class="btn btn-primary text-auto"><i class="fas fa-eye"></i> Lihat Data</a>
            </div>
        </div>
        <div class="card-body">
            <form action="/sub-aktivitas/create" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row mt-3">
                    <div class="col-2">
                        <label for="" class="form-label">Name</label>
                    </div>
                    <div class="col-8"><input name="name" class="form-control" type="text" required></div>
                </div>
                <div class="row mt-3">
                    <div class="col-2">
                        <label for="" class="form-label">Aktivitas</label>
                    </div>
                    <div class="col-8">
                        <select name="aktivitas_id" id="aktivitas_id" class="form-control " required>
                            <option value="">-- pilih aktivitas --</option>
                            @foreach ($data_aktivitas as $dta)
                            <option value="{{$dta->id}}">{{$dta->name}}</option>
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