@extends('layouts.app')

@section('content-login')
<div class="card ">
    <div class="card-header text-center"><a href="#"><img class="logo-img" src="{{ asset('LogoNavbar.png') }}" alt="logo"></a><span class="splash-description">Completa La Informacion Para Iniciar Session</span></div>
    <div class="card-body">
        <form method="POST" action="{{ route('login') }}" novalidate>
            @csrf
            <div class="form-group">
                <input class="form-control form-control-lg @error('email') is-invalid @enderror" id="email" name="email" type="text" placeholder="Correo Electronico" autocomplete="off" value="{{ old('email') }}" autofocus required>

                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <input class="form-control form-control-lg @error('password') is-invalid @enderror" id="password" type="password" name="password" required placeholder="Password">

                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary btn-lg btn-block">Iniciar Session</button>
        </form>
    </div>
    <div class="form-group has-danger has-error has-feedback">
        <h3 class="invalid-feedback"><b>{{ $errors->has('message') ? $errors->first('message',':message') : '' }}</b></h3>
    </div>
</div>
@endsection
