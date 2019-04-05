@extends('layouts.guest')

@section('error')
    @if ($errors->any())
        <div class="alert bg-danger" role="alert">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
@endsection

@section('content')
    <h3><center>CADASTRO</center></h3><br/>
    <form role="form" method="POST" action="{{ route('register') }}">
        @csrf
        <fieldset>
            <h4>Dados de acesso:</h4>
            <div class="form-group">
                <input id="name" type="text" placeholder="Nome" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>
            </div>
            <div class="form-group">
                <input id="email" type="email" placeholder="E-mail" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>
            </div>
            <div class="form-group">
                <input id="password" type="password" placeholder="Senha" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
            </div>
            <div class="form-group">
                <input id="password-confirm" type="password" placeholder="Confirmar senha" class="form-control" name="password_confirmation" required>
            </div>
            <div class="checkbox">
                <label>
                    <input name="aceito" type="checkbox" value="aceito">Concordo em receber notícias e promoções.
                </label>
            </div>
            <button type="submit" class="btn btn-primary">
                Cadastrar-se
            </button>
        </fieldset>
    </form>
    <div class="cadastrese">
        <a href="{{ route('login') }}">Retornar para o login</a>
    </div>
@endsection
