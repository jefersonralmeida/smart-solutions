@php
/** @var \App\Patient $patient */
@endphp
@extends('layouts.main')

@section('content')
    <div class="panel panel-default">
        <div class="panel-body">
            @if ($errors->any())
                <div class="alert bg-warning" role="alert">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{!! $error !!}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="col-lg-12">
                <form method="POST" action="{{ $action }}">
                    @csrf
                    @method ($method)

                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="name">
                                Nome do paciente:
                            </label>
                            <input class="form-control" id="name" name="name" placeholder="Digite o nome completo"
                                   value="{{ old('name') ?? $patient->name ?? '' }}"/>
                        </div>
                        <div class="form-group">
                            <label for="birthday">
                                Data de Nascimento:
                            </label>
                            <input class="form-control" id="birthday" name="birthday" placeholder="Digite a data de nascimento"
                                   value="{{ old('birthday') ?? (isset($patient) ? $patient->birthday->format('d/m/Y') : '') }}"/>
                        </div>
                        <div class="form-group">
                            <label for="email">
                                E-mail:
                            </label>
                            <input class="form-control" id="email" name="email" placeholder="Digite o e-mail"
                                   value="{{ old('email') ?? $patient->email ?? '' }}"/>
                        </div>
                        <div class="form-group">
                            <label for="phone">
                                Telefone:
                            </label>
                            <input class="form-control" id="phone" name="phone"
                                   placeholder="Digite o telefone {{ config('masks.phone') }}"
                                   value="{{ old('phone') ?? $patient->phone ?? '' }}"/>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="city">
                                Cidade:
                            </label>
                            <input class="form-control" id="city" name="city" placeholder="Digite a cidade"
                                   value="{{ old('city') ?? $patient->city ?? '' }}"/>
                        </div>
                        <div class="form-group">
                            <label for="state">
                                Estado:
                            </label>
                            <select class="form-control" style="height: 47px;" id="state" name="state">
                                <option value="">Selecione</option>
                                @foreach (config('states') as $state)
                                    <option
                                            {{ (old('state') ?? $patient->state ?? '') == $state ? 'selected' : '' }}
                                            value="{{ $state }}"
                                    >
                                        {{ $state }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="gender">
                                Sexo:
                            </label>
                            <select class="form-control" style="height: 47px;" id="gender" name="gender">
                                <option value="">Selecione</option>
                                <option value="M" {{ (old('gender') ?? $patient->gender ?? '') == 'M' ? 'selected' : '' }}>Masculino</option>
                                <option value="F" {{ (old('gender') ?? $patient->gender ?? '') == 'F' ? 'selected' : '' }}>Feminino</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="cellphone">
                                Celular:
                            </label>
                            <input class="form-control" id="cellphone" name="cellphone"
                                   placeholder="Digite o telefone {{ config('masks.cellphone') }}"
                                   value="{{ old('cellphone') ?? $patient->cellphone ?? '' }}"/>
                        </div>
                    </div>
                    <div class="col-lg-12">&nbsp;</div>
                    <div class="col-lg-12">
                        <button type="submit" class="btn btn-primary">Gravar Paciente</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script language="javascript">
        $('#birthday').mask('{{ config('masks.date')}}');
        $('#phone').mask('{{ config('masks.phone')}}');
        $('#cellphone').mask('{{ config('masks.cellphone')}}');
    </script>
@endsection
