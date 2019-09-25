@php
/** @var \App\Dentist $dentist */
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
                            <label for="cro">
                                CRO:
                            </label>
                            <input class="form-control" id="cro" name="cro" placeholder="Digite o CRO (Formato: UF-9999)"
                                   value="{{ old('cro') ?? $dentist->cro ?? '' }}"/>
                        </div>
                        <div class="form-group">
                            <label for="phone">
                                Telefone:
                            </label>
                            <input class="form-control" id="phone" name="phone"
                                   placeholder="Digite o telefone"
                                   value="{{ old('phone') ?? $dentist->phone ?? '' }}"/>
                        </div>
                        <div class="form-group">
                            <label for="cpf">
                                CPF:
                            </label>
                            <input class="form-control" id="cpf" name="cpf" placeholder="Digite o CPF"
                                   value="{{ old('cpf') ?? $dentist->cpf ?? '' }}"/>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="city">
                                Cidade:
                            </label>
                            <input class="form-control" id="city" name="city" placeholder="Digite a cidade"
                                   value="{{ old('city') ?? $dentist->city ?? '' }}"/>
                        </div>
                        <div class="form-group">
                            <label for="state">
                                Estado:
                            </label>
                            <select class="form-control" style="height: 47px;" id="state" name="state">
                                <option value="">Selecione</option>
                                @foreach (config('states') as $state)
                                    <option
                                            {{ (old('state') ?? $dentist->state ?? '') == $state ? 'selected' : '' }}
                                            value="{{ $state }}"
                                    >
                                        {{ $state }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="cellphone">
                                Celular:
                            </label>
                            <input class="form-control" id="cellphone" name="cellphone"
                                   placeholder="Digite o telefone {{ config('masks.cellphone') }}"
                                   value="{{ old('cellphone') ?? $dentist->cellphone ?? '' }}"/>
                        </div>
                    </div>
                    <div class="col-lg-12">&nbsp;</div>
                    <div class="col-lg-12">
                        <button type="submit" class="btn btn-primary">Completar Cadastro</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script language="javascript">
        $('#cpf').mask('{{ config('masks.cpf')}}');
        $('#phone').mask('{{ config('masks.phone')}}');
        $('#cellphone').mask('{{ config('masks.cellphone')}}');
        $('#user_id').on('change', function () {
            if ($('#user_id').val() === '') {
                $("#name").prop('disabled', false);
                $("#email").prop('disabled', false);
            } else {
                $("#name").prop('disabled', true);
                $("#email").prop('disabled', true);
            }
        });
        $('#user_id').change();
    </script>
@endsection
