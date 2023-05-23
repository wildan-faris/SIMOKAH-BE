@extends('template.auth')
@section('title', 'Kepala Sekolah')
@section('content')

<div class="card-body login-card-body">
    <h4 class="login-box-msg">LOGIN</h4>
    @if ($message = Session::get('success'))
    <div class="alert alert-success alert-dismissible" role="alert">
        {{$message}}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    @if ($message = Session::get('failed'))
    <div class="alert alert-danger alert-dismissible" role="alert">
        {{$message}}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    <form action="/ahli-parenting/login" method="post">
        @csrf
        <div class="input-group mb-3">
            <input type="email" class="form-control" placeholder="Email" name="email" required>
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-envelope"></span>
                </div>
            </div>
        </div>
        <div class="input-group mb-3">
            <input type="password" class="form-control" placeholder="Password" name="password" required>
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-lock"></span>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-8">
                <div class="icheck-primary">
                    <input type="checkbox" id="remember">
                    <label for="remember">
                        Remember Me
                    </label>
                </div>
            </div>
            <!-- /.col -->
            <div class="col-4">
                <button type="submit" class="btn btn-primary btn-block">Sign In</button>
            </div>
            <!-- /.col -->
        </div>
    </form>


    <!-- /.social-auth-links -->


</div>

@endsection