@extends('layouts.app')

@section('content')

    <div class="login-bok">
        <img class="avatar" src="/vendor/adminlte/dist/img/Logo2.png" alt="" >
        <h5>BIENVENIDO AL
            SISTEMA DE GESTIÓN ASISTENCIA DOCENTE</h5>
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <!--USERNAME-->
            <label for=" email">E-Mail</label>
            <input id="email" type="email" name="email" placeholder="Ingresar e-mail" value="{{ old('email') }}">
            @error('email')
                <small class="danger"> {{ $message }}</small>
            @enderror
            <!--PASSWORD-->
            <label for="password">Password</label>
            <input id="password" type="password" placeholder="Ingresar su password" name="password">
            @error('password')
                <small class="danger"> {{ $message }}</small>

            @enderror
            <center><button type="submit" id="bto1" class="btn11">Login</button></center>
        </form>
    </div>

    {{-- <div class="container ">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="col-md-8 justify-content-right">
                    <h1 class="bs-gray-200">BIENVENIDO AL SISTEMA DE ASISTENCIA DOCENTE</h1>
                </div>
                <div class="card">
                    <div class="card-body">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <div class="row mb-3">

                                <label for="email"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Usuario:') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                        name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="password"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Contraseña') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        required autocomplete="current-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                            <div class="row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary"> <i class="fas fa-sign-in-alt"></i>
                                        {{ __('Login') }}
                                    </button>

                                    @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
@endsection
