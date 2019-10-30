@extends('layouts.guest')

@section('error')
    @if ($errors->has('email'))
        <div class="alert bg-danger" role="alert">
            Login ou senha inválida. Se está com dificuldade em acessar sua conta tente
            <a href="{{ route('password.request') }}">recuperar a senha</a>.
        </div>
    @endif
@endsection

@section('content')
    <form method="POST" action="{{ route('login') }}">
        @csrf

        <fieldset>
            <div class="form-group">
                <input class="form-control" placeholder="E-mail" name="email" type="email" autofocus="">
            </div>
            <div class="form-group">
                <input class="form-control" placeholder="Senha" name="password" type="password" value="">
            </div>
            <div class="checkbox">
                <label>
                    <input class="form-check-input" type="checkbox" name="remember"
                           id="remember" {{ old('remember') ? 'checked' : '' }}>
                    Lembrar-me
                </label>
            </div>
            <button type="submit" class="btn btn-primary">
                Entrar
            </button>
        </fieldset>
    </form>
    <div class="cadastrese">
        <a class="btn btn-link" href="{{ route('password.request') }}">Esqueci a senha</a> |
        <a class="nav-link" href="{{ route('register') }}">Cadastrar-se</a>
    </div>
    <hr/>
    <a href="{{ route('socialLogin', 'facebook') }}" class="btn btn-primary"><i class="fa fa-facebook-square"></i> Continuar com o Facebook</a>
    <a href="{{ route('socialLogin', 'google') }}" class="btn btn-danger"><i class="fa fa-google-plus-square"></i> Continuar com o Google</a>
@endsection

