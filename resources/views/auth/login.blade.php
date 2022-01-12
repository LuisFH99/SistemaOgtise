@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8"><br><br>
            
            <div class="login-bok ">
                <img class="avatar" src="\vendor\adminlte\dist\img\Logo3.png" alt="Logo Asistencia Docente">
                <h1 style="color: #000">Login Asistencia Docente</h1>
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <!--USERNAME-->
                    {{-- <label for="username">Username</label> --}}
                    <label for="email" class="text-secondary">{{ __('E-Mail Address') }}</label>
                    {{-- <input type="text" placeholder="Enter username" id="user"> --}}
                    <input id="email" type="email" placeholder="Enter E-mail" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <!--PASSWORD-->
                    {{-- <label for="password">Password</label> --}}
                    <label for="password" class="text-secondary">{{ __('Password') }}</label>
                    {{-- <input type="password" placeholder="Enter Password" id="pw"> --}}
                    <input id="password" type="password" placeholder="Enter Password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    {{-- <div class="form-check">
                        
                        <label class="form-check-label text-secondary" for="remember">
                            <input class="" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            {{ __('Remember Me') }}
                        </label>
                    </div> --}}
                    <div class="col-md-6 mr-1"><br><br>
                        {{-- <label class="text-primary">
                            <input class="alicb" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            Recordar
                        </label> --}}
                    </div>
                    <center>
                        {{-- <button id="bto1" class="btn btn-primary">Ingresar</button> --}}
                        <button type="submit" class="btn11 btn btn-primary">
                            {{ __('Login') }}
                        </button>
                    </center>
                    @if (Route::has('password.request'))
                        <a class="btn btn-link" href="{{ route('password.request') }}">
                            {{ __('Forgot Your Password?') }}
                        </a>
                    @endif
                </form>
            </div>
            {{-- <div class="card">
                <div class="card-header">{{ __('Login') }}</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="row mb-4">
                            <label for="Perfil" class="col-md-4 col-form-label text-md-right">{{ __('Perfil') }}</label>
                            <div class="col-md-6">
                                <select class="form-select" aria-label="Seector Rol" id="cbPerfiles" onChange='selecPer(this.value);' onselect='selecPer(this.value);'>
                                    <option >Seleccione...</option>
                                    <option value="1" selected>Docente</option>
                                    <option value="2" >Dpto. Academico</option>
                                    <option value="3" >Decano</option>
                                    <option value="4" >URyC</option>
                                    <option value="5" >Administrador</option>
                                </select>
                            </div>
                        </div>
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
            </div> --}}
        </div>
    </div>
@endsection

