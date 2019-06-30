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
                </div>
            </div>
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-body">
            <form method="POST" action="https://shopline.itau.com.br/shopline/shopline.aspx">
                @csrf
                <input type="hidden" name="DC" value="{{ $data }}"/>
                <button type="submit" class="btn btn-primary">Realizar Pagamento</button>
            </form>
        </div>
    </div>
@endsection