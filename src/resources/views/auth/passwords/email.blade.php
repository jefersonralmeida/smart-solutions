@extends('layouts.guest')

@section('error')
    @if ($errors->has('email'))
        <div class="alert bg-danger" role="alert">
            {{ $errors->first('email') }}
        </div>
    @endif
@endsection

@section('content')
    <div class="container" style="width: 430px">

        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}">
            @csrf
            <fieldset>
                <div class="form-group">
                        <input id="email" type="email" class="form-control"
                               name="email" value="{{ old('email') }}" placeholder="E-mail" required />
                </div>
                <button type="submit" class="btn btn-primary">
                    Enviar link de renovação
                </button>
            </fieldset>
        </form>
    </div>
@endsection
