@php
    /** @var array[] $files */
    /** @var \App\Order $order */
@endphp
@extends('layouts.main')

@section('content')
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="col-lg-12" style="background-color: #c8e0f0; margin-top: 15px; padding-top: 20px;">
                <div class="col-lg-6">
                    <p>Produto:&nbsp;&nbsp;<b>{{ $order->product_name }}</b></p>
                    <p>Nome do dentista:&nbsp;&nbsp;<b>{{ $order->dentist->name }}</b></p>
                    <p>Nome do paciente:&nbsp;&nbsp;<b>{{ $order->patient->name }}</b></p>
                    <p>Envio:&nbsp;&nbsp;<b>{{ $order->shipping }}</b></p>
                    <p>Valor do Pedido:&nbsp;&nbsp;<b>R$ {{ number_format($order->value, 2, ',', ' ') }}</b></p>
                    <p>Forma de envio:&nbsp;&nbsp;<b>{{ $order->shipping }}</b></p>
                    <p>Valor do Envio:&nbsp;&nbsp;<b>R$ {{ number_format($order->shipping_value, 2, ',', ' ') }}</b></p>
                    <p>Valor total:&nbsp;&nbsp;<b>R$ {{ number_format($order->total_value, 2, ',', ' ') }}</b></p>
                </div>
            </div>
        </div>
    </div>
    <div class="panel panel-default">
        <div id="payment-panel" class="panel-body">
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
                <input id="radio-boleto" type="radio" name="payment_method" style="position: relative; top: -4px;"
                       value="boleto"/>
                &nbsp;
                <i class="fa fa-barcode fa-2x"></i>
                &nbsp;
                <label for="radio-boleto" style="position: relative; top: -4px;">Pagar com Boleto</label>
            </div>
            <div id="panel-boleto" class="col-lg-12" style="margin: 20px;">
                <form method="POST" action="https://shopline.itau.com.br/shopline/shopline.aspx"
                      class="form form-inline" style="position: relative; top: -4px;">
                    @csrf
                    <input type="hidden" name="DC" value="{{ $data }}"/>
                    <button type="submit" class="btn btn-primary">
                        Clique aqui para pagar
                    </button>
                    &nbsp;&nbsp;
                    <span>* Você será redirecionado para o ambiente seguro do banco, para efetuar o pagamento.</span>
                </form>
            </div>
            <div class="col-lg-12">
                <hr/>
            </div>
            <div class="col-lg-12">
                <input id="radio-card" type="radio" name="payment_method" style="position: relative; top: -4px;"
                       value="card"/>
                &nbsp;
                <i class="fa fa-credit-card-alt fa-2x"></i>
                &nbsp;
                <label for="radio-card" style="position: relative; top: -4px;">Pagar com Cartão de Crédito</label>
            </div>
            <div id="panel-card" class="col-lg-12" style="margin: 20px;">
                <style>
                    #panel-boleto {
                        display: none;
                    }

                    #panel-card {
                        display: none;
                    }
                </style>
                <form method="POST" action="{{ route('orders.pay.rede', $order->id) }}" class="form">
                    @csrf

                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="numero_cartao">
                                Número do cartão:
                            </label>
                            <input id="numero_cartao" type="text" name="card_number" class="form-control"/>
                        </div>
                        <div class="form-group">
                            <label for="card_holder">
                                Nome Impresso no Cartão
                            </label>
                            <input type="text" id="card_holder" name="card_holder" class="form-control"/>
                        </div>
                        <div class="form-group">
                            <label for="numero_cartao">
                                Validade (mm/aa):
                            </label>
                            <input type="text" name="expiration" class="form-control" placeholder="00/00"/>
                        </div>
                        <div class="form-group">
                            <label for="card_holder">
                                Código de segurança:
                            </label>
                            <input type="text" name="security_code" class="form-control" placeholder="000">
                        </div>
                    </div>

                    <input type="hidden" name="amount" value="{{ $order->value }}"/>
                    <div class="col-lg-12">
                        <br/>
                    </div>
                    <div class="col-lg-12">
                        <button class="btn btn-primary">Efetuar Pagamento</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script language="javascript">
        $('#panel-card input[type=text][name=card_number]').mask('9999 9999 9999 9999');
        $('#panel-card input[type=text][name=expiration]').mask('99/99');

        $('#payment-panel input[type=radio]').on('change', function () {
            if ($(this).val() == 'boleto') {
                $('#panel-boleto').show();
                $('#panel-card').hide();
            } else {
                $('#panel-boleto').hide();
                $('#panel-card').show();
                $('#panel-card input[type=text][name=card_number]').focus();
            }
        });
        $('#panel-card input[type=text][name=card_number]').on('keyup', function () {
            var input = $(this).val();

            var companySprite = $('#panel-card .credit-card .company');

            // VISA
            if (input.match(/^4/)) {
                companySprite.css('background-position-x', 0);
                companySprite.css('background-position-y', 0);
                return;
            }

            // MASTER
            if (input.match(/^5/)) {
                companySprite.css('background-position-x', '-69px');
                companySprite.css('background-position-y', 0);
                return;
            }

            // NONE
            console.log('none');
            companySprite.css('background-position-x', 70);
            companySprite.css('background-position-y', 0);

        });
    </script>
@endsection
