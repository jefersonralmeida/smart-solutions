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
            <div class="col-lg-12">
                <h4>Endereço de Entrega: </h4>
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
                        />
                    </div>
                    <label for="address_{{ $address->id }}" class="col-lg-11"
                           style=" display: block; background-color: #c8e0f0; margin-top: 15px; padding-top: 20px; cursor: pointer;">
                        @include ('addresses.cell', ['address' => $address])
                    </label>
                </div>
            @endforeach
            <div class="col-lg-12">
                <a href="#">Adicionar Endereço</a>
            </div>
            <div class="col-lg-12">
                <hr/>
            </div>
            <div class="col-lg-12">
                <h4>Dados de Cobrança: </h4>
            </div>
            <div class="col-lg-12">
                <input id="dados_cobranca_opcao_automatico" type="radio" name="dados_cobranca_opcao"/>
                <label for="dados_cobranca_opcao_automatico">Preencher automaticamente com dados do
                    dentista/clínica.</label>
            </div>
            <div class="col-lg-12">
                <input id="dados_cobranca_opcao_preencher" type="radio" name="dados_cobranca_opcao"/>
                <label for="dados_cobranca_opcao_preencher">Preencher com outros dados:</label>
            </div>
            <div class="col-lg-12">
                <br/>
            </div>
            <div class="col-lg-12">
                <div class="form-group">
                    <label for="cobranca_nome_completo">
                        Nome Completo:
                    </label>
                    <input type="text" id="cobranca_nome_completo" class="form-control" name="cobranca_nome_completo"/>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="form-group">
                    <label for="cobranca_cpf">
                        CPF:
                    </label>
                    <input type="text" id="cobranca_cpf" class="form-control"/>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="form-group">
                    <label for="cobranca_endereco">
                        Endereço Completo:
                    </label>
                    <input type="text" id="cobranca_endereco" class="form-control"/>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label for="cep">
                        CEP:
                    </label>
                    <input type="text" id="cep" class="form-control"/>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label for="phone">
                        Principal Telefone:
                    </label>
                    <input type="text" id="phone" class="form-control"/>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="form-group">
                    <label for="email">
                        Email:
                    </label>
                    <input type="email" id="email" class="form-control"/>
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
                        <input type="radio" name="shippingProvider" value="{{ $provider }}"
                               id="shippingProvider_{{ $provider }}"/>
                        <label for="shippingProvider_{{ $provider }}" id="label_shippingProvider_{{ $provider }}">
                            <b></b> | R$ <span class="price"></span> | <span class="prize"></span>
                        </label>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script language="javascript">
        $('input[type=radio][name=address_id]').on('change', function (x) {
            const zip = $(this).attr('data-zipcode');
            $('#shippingBox').hide();
            $.each($('.shipping-provider'), function (index, item) {
                const provider = $(item).find('input[type=radio]').val();
                const url = '/api/shipping-info/' + provider + '/' + zip;
                $.get(url, '', function (response) {
                    if (response) {
                        console.log(response);
                        $(item).find('label b').html(response.name);
                        $(item).find('label span.price').html(response.price);
                        $(item).find('label span.prize').html(response.deliveryPrize);
                        $(item).show();
                    } else {
                        $(item).hide();
                    }
                });
            });
            $('#shippingBox').show();
        });
    </script>
@endsection