@php
    /** @var \App\Address $address */
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
                            <label for="identification">
                                Identificação (um nome para identificar o endereço):
                            </label>
                            <input class="form-control" id="identification" name="identification" placeholder="Casa, consultório, clínica"
                                   value="{{ old('identification') ?? $address->identification ?? '' }}"/>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="receiver_name">
                                Nome do recebedor:
                            </label>
                            <input class="form-control" id="receiver_name" name="receiver_name" placeholder="Digite o nome"
                                   value="{{ old('receiver_name') ?? $address->receiver_name ?? '' }}"/>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="form-group">
                            <label for="zip_code">
                                CEP:
                            </label>
                            <input class="form-control" id="zip_code" name="zip_code" placeholder="Digite o CEP"
                                   value="{{ old('zip_code') ?? $address->zip_code ?? '' }}"/>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="street">
                                Rua:
                            </label>
                            <input class="form-control" id="street" name="street" placeholder="Digite a Rua"
                                   value="{{ old('street') ?? $address->street ?? '' }}" {{ old('zip_code') || !empty($address->zip_code) ? '' : 'disabled' }}/>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="form-group">
                            <label for="street_number">
                                Número:
                            </label>
                            <input class="form-control" id="street_number" name="street_number"
                                   placeholder="Digite o número"
                                   value="{{ old('street_number') ?? $address->street_number ?? '' }}" {{ old('zip_code') || !empty($address->zip_code) ? '' : 'disabled' }}/>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="address_details">
                                Complemento:
                            </label>
                            <input class="form-control" id="address_details" name="address_details" placeholder="Digite o Complemento"
                                   value="{{ old('address_details') ?? $address->address_details ?? '' }}" {{ old('zip_code') || !empty($address->zip_code) ? '' : 'street' }}/>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="district">
                                Bairro:
                            </label>
                            <input class="form-control" id="district" name="district" placeholder="Digite o Bairro"
                                   value="{{ old('district') ?? $address->district ?? '' }}" {{ old('zip_code') || !empty($address->zip_code) ? '' : 'disabled' }}/>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="city">
                                Cidade:
                            </label>
                            <input class="form-control" id="city" name="city" placeholder="Digite a cidade"
                                   value="{{ old('city') ?? $address->city ?? '' }}" {{ old('zip_code') || !empty($address->zip_code) ? '' : 'disabled' }}/>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="form-group">
                            <label for="state">
                                Estado:
                            </label>
                            <select class="form-control" style="height: 47px;" id="state" name="state" {{ old('zip_code') || !empty($address->zip_code) ? '' : 'disabled' }}>
                                <option value="">Selecione</option>
                                @foreach (config('states') as $state)
                                    <option
                                            {{ (old('state') ?? $address->state ?? '') == $state ? 'selected' : '' }}
                                            value="{{ $state }}"
                                    >
                                        {{ $state }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="reference_point">
                                Ponto de Referência:
                            </label>
                            <input class="form-control" id="reference_point" name="reference_point"
                                   placeholder="Digite o ponto de referência"
                                   value="{{ old('reference_point') ?? $address->reference_point ?? '' }}"/>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="phone">
                                Telefone:
                            </label>
                            <input class="form-control" id="phone" name="phone"
                                   placeholder="Digite o telefone {{ config('masks.phone') }}"
                                   value="{{ old('phone') ?? $address->phone ?? '' }}"/>
                        </div>
                    </div>
                    <div class="col-lg-12">&nbsp;</div>
                    <div class="col-lg-12">
                        <button type="submit" class="btn btn-primary">Gravar endereço</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script language="javascript">
        $('#zip_code').mask('99999-999');
        $('#phone').mask('{{ config('masks.phone')}}');
        $('#zip_code').on('change', function () {
            let zip = $('#zip_code').val();
            zip = zip.replace('-', '');
            if (zip.search(/^[0-9]{8}$/) < 0) {
                alert('CEP inválido');
                return false;
            }
            let street = $('#street');
            let street_number = $('#street_number');
            let address_details = $('#address_details');
            let district = $('#district');
            let city = $('#city');
            let state = $('#state');

            const url = 'https://viacep.com.br/ws/' + zip + '/json/';
            $.get(url, '', function (response) {
                street.val(response.logradouro);
                street.prop('disabled', false);
                street_number.prop('disabled', false);
                address_details.prop('disabled', false);

                district.val(response.bairro);
                district.prop('disabled', false);
                city.val(response.localidade);
                city.prop('disabled', false);
                state.val(response.uf);
                state.prop('disabled', false);

                if (street.val()) {
                    street_number.focus();
                } else {
                    street.focus();
                }

            });

        });
    </script>
@endsection
