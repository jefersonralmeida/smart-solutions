@php
    /** @var \App\Order $order */
    /** @var \App\Dentist $dentist */
    /** @var \App\Patient $patient */
    /** @var \App\Address[]|\Illuminate\Database\Eloquent\Collection $addresses */
    /** @var array $shippingProviders */
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
        </div>
        <div class="panel-body">
            <div class="col-lg-12">
                <h4>Dados do Dentista</h4>
            </div>
            @include ('dentists.cell', ['dentist' => $dentist])
            <div class="col-lg-12">
                <hr/>
            </div>
            <div class="col-lg-12">
                <h4>Dados do Paciente</h4>
            </div>
            @include ('patients.cell', ['patient' => $patient])
            <div class="col-lg-12">
                <hr/>
            </div>
        </div>
        <div class="panel-body">
            <div class="col-lg-12">
                <h4>Endereço de Entrega: </h4>
            </div>
            <form method="post">
                @csrf

                <div>
                    <hr/>
                </div>

                @foreach ($addresses as $address)
                    <div class="row">
                        <div class="col-lg-1" style="width: 40px; margin-top: 30px;">
                            <input
                                    id="address_{{ $address->id }}"
                                    type="radio"
                                    name="address_id"
                                    value="{{ $address->id }}"
                                    style="margin: auto; cursor: pointer;"
                                    data-zipcode="{{ str_replace('-', '', $address->zip_code) }}"
                                    {{ old('address_id') == $address->id ? 'checked' : '' }}
                            />
                        </div>
                        <label for="address_{{ $address->id }}" class="col-lg-11"
                               style=" display: block; background-color: #c8e0f0; margin-top: 15px; padding-top: 20px; cursor: pointer;">
                            @include ('addresses.cell', ['address' => $address])
                        </label>
                    </div>
                @endforeach
                <div class="col-lg-12">
                    <a href="{{ route('addresses.create', ['redirect' => route('orders.confirm', [$order->id])]) }}">Adicionar Endereço</a>
                </div>
                <div class="col-lg-12">
                    <hr/>
                </div>
                <div class="col-lg-12">
                    <h4>Dados de Cobrança: </h4>
                </div>
                <div class="col-lg-12">
                    <input id="dados_cobranca_opcao_automatico" type="radio" name="billing_data" value="auto"
                           checked/>
                    <label for="dados_cobranca_opcao_automatico">Preencher automaticamente com dados do
                        dentista/clínica.</label>
                </div>
                <div class="col-lg-12">
                    <input
                            id="dados_cobranca_opcao_preencher"
                            type="radio"
                            name="billing_data"
                            value="manual"
                            {{ old('billing_data') == 'manual' ? 'checked' : '' }}
                    />
                    <label for="dados_cobranca_opcao_preencher">Preencher com outros dados:</label>
                </div>
                <div class="col-lg-12">
                    <br/>
                </div>
                <div id="dados_cobranca_form" style="display: {{ old('billing_data') == 'manual' ? 'block' : 'none' }};">
                    <div class="col-lg-7">
                        <div class="form-group">
                            <label for="cobranca_nome_completo">
                                Nome Completo:
                            </label>
                            <input type="text" id="cobranca_nome_completo" class="form-control"
                                   name="billing_name"/>
                        </div>
                    </div>
                    <div class="col-lg-5">
                        <div class="form-group">
                            <label for="cobranca_cpf">
                                CPF:
                            </label>
                            <input type="text" id="cobranca_cpf" class="form-control" name="billing_document"/>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="form-group">
                            <label for="zip_code">
                                CEP:
                            </label>
                            <input class="form-control" id="zip_code" name="billing_zip_code" placeholder="Digite o CEP"
                                   value="{{ old('billing_zip_code') }}"/>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="street">
                                Rua:
                            </label>
                            <input class="form-control" id="street" name="billing_street" placeholder="Digite a Rua"
                                   value="{{ old('billing_street') }}" {{ old('billing_zip_code')  ? '' : 'disabled' }}/>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="form-group">
                            <label for="street_number">
                                Número:
                            </label>
                            <input class="form-control" id="street_number" name="billing_street_number"
                                   placeholder="Digite o número"
                                   value="{{ old('billing_street_number')}}" {{ old('billing_zip_code') ? '' : 'disabled' }}/>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="address_details">
                                Complemento:
                            </label>
                            <input class="form-control" id="address_details" name="billing_address_details" placeholder="Digite o Complemento"
                                   value="{{ old('billing_address_details') }}" {{ old('billing_zip_code') ? '' : 'street' }}/>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="district">
                                Bairro:
                            </label>
                            <input class="form-control" id="district" name="billing_district" placeholder="Digite o Bairro"
                                   value="{{ old('billing_district') }}" {{ old('billing_zip_code') ? '' : 'disabled' }}/>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="city">
                                Cidade:
                            </label>
                            <input class="form-control" id="city" name="billing_city" placeholder="Digite a cidade"
                                   value="{{ old('billing_city') ?? '' }}" {{ old('billing_zip_code') ? '' : 'disabled' }}/>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="form-group">
                            <label for="state">
                                Estado:
                            </label>
                            <select class="form-control" style="height: 47px;" id="state" name="billing_state" {{ old('billing_zip_code') ? '' : 'disabled' }}>
                                <option value="">Selecione</option>
                                @foreach (config('states') as $state)
                                    <option
                                        value="{{ $state }}"
                                    >
                                        {{ $state }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="email">
                                Email:
                            </label>
                            <input type="email" id="email" class="form-control" name="billing_email"/>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <hr/>
                </div>
                <div class="col-lg-12">
                    <h4>Formas de Entrega: </h4>
                </div>
                <div id="shippingBox" style="display: none;">
                    @foreach ($shippingProviders as $provider)
                        <div class="col-lg-12 shipping-provider" style="display: none">
                            <input type="radio" name="shipping" value="{{ $provider }}"
                                   id="shippingProvider_{{ $provider }}"/>
                            <label for="shippingProvider_{{ $provider }}" id="label_shippingProvider_{{ $provider }}">
                                <b></b> | R$ <span class="price"></span>
                            </label>
                        </div>
                    @endforeach
                </div>
                <div id="shippingMessage">
                    <p>Selecione um endereço de entrega para visualizar as opções de entrega.</p>
                </div>
                <div style="margin-top: 20px;">
                    <button class="btn btn-success">Confirmar Pedido</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script language="javascript">
        $('input[type=radio][name=billing_data]').on('change', function () {
            if ($(this).val() == 'auto') {
                $('#dados_cobranca_form').hide();
            } else {
                $('#dados_cobranca_form').show();
            }
        });

        const getShippingInfo = function (zip) {
            if (!zip) return;

            $.each($('.shipping-provider'), function (index, item) {
                const provider = $(item).find('input[type=radio]').val();
                const url = '/api/shipping-info/' + provider + '/' + zip;
                $.get(url, '', function (response) {
                    if (response) {
                        $(item).find('label b').html(response.name);
                        $(item).find('label span.price').html(response.price);
                        $(item).find('label span.prize').html(response.deliveryPrize);
                        $(item).show();
                    } else {
                        $(item).hide();
                    }
                });
            });
            $('#shippingMessage').hide();
            $('#shippingBox').show();
        };

        $('input[type=radio][name=address_id]').on('change', function() {
            getShippingInfo($(this).attr('data-zipcode'));
        });

        getShippingInfo('{{ $addresses->find(old('address_id'))->zip_code  ?? ''}}');

        // completar com cep
        $('#cobranca_cpf').mask('999.999.999-99');
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
