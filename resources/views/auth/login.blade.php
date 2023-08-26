@extends('layouts.masterauth')

@section('title', 'Login')

@section('content')
    <div class="d-flex justify-content-center" style="margin-top:60px">
        <div class="col-sm-10">
            <div class="card shadow-lg rounded">
                <div class="card-body login-card-body">
                    <div class="row">
                        <div class="col-md-6 d-none d-md-block text-center">
                            <img src="{{ asset('assets/images/siguna.jpeg') }}" style="height: 300px;" class="img-fluid"
                                alt="Background">
                        </div>
                        <div class="col-md-6">
                            <h4 class="font-weight-bold">Gunaksa PPK Ormawa</h4>
                            <p class="text-mute small text-left">Masuk untuk memulai sesi</p><br>
                            <form method="POST" action="{{ route('login') }}" autocomplete="off">
                                @csrf
                                @method('POST')
                                <div class="form-group mb-4">
                                    <label for="username">Username</label>
                                    <div class="input-group">
                                        <input type="username" id="username" name="username" value=""
                                            class="form-control" placeholder="Masukkan Username" autofocus=""
                                            autocomplete="off">
                                        <div class="input-group-append">
                                            <div class="input-group-text">
                                                <span class="fas fa-user"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group mb-4">
                                    <label for="">Password</label>
                                    <div class="input-group">
                                        <input type="password" id="password" name="password" value=""
                                            class="form-control" placeholder="Masukkan Password"
                                            autocomplete="current-password">
                                        <div class="input-group-append">
                                            <div class="input-group-text"><span class="fas fa-lock"></span></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">

                                    <div class="col-12 form-group"><button class="btn btn-primary btn-block"><i
                                                class="fas fa-sign-in-alt"></i> Masuk</button></div>
                                </div>
                                <div class="row">
                                    @if ($errors->has('match'))
                                        <div class="col-12" id="container-error">
                                            <div class="alert alert-danger mb-0">
                                                <i class="icon fas fa-exclamation"></i>
                                                {{ $errors->first('match') }}
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </form>
                            <div class="social-auth-links text-center mb-3">
                                <p class="border p-2 bg-gray-light small">Copyright &copy; 2023 Desa Gunaksa</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
