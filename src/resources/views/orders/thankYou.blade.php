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
                </div>
            </div>
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-body">
            <h2>Obrigado!</h2>
            <p>A equipe Smart Solutions agradece sua compra!</p>
            <p>Assim que seu pagamento for confirmado pela instituição bancária, daremos prosseguimento ao seu projeto.</p>
            <p>Você pode acompanhar o andamento deste e outros pedidos na <a href="{{ route('orders') }}">página de pedidos</a>.</p>
        </div>
    </div>
@endsection