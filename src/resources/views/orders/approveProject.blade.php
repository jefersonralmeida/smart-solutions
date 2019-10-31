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
            <h3>Arquivos do projeto:</h3>
            <p>Os arquivos abaixo devem ser verificados pelo dentista solicitante.</p>
            <hr/>
            <ul>
                @foreach($files as $fileInfo)
                    <li>
                        <a href="{{ $fileInfo['uri'] }}">{{ $fileInfo['fileName'] }} ({{$fileInfo['size']}})</a>
                    </li>
                @endforeach
            </ul>
            <hr/>
            <div class="row">
                <div class="col-lg-2">
                    <form method="POST" action="{{ route('orders.approve', ['order' => $order->id]) }}">
                        @csrf
                        <button type="submit" class="btn btn-success">Aprovar Projeto</button>
                    </form>
                </div>
                <div class="col-lg-2">
                    <form method="POST" action="{{ route('orders.cancel', ['order' => $order->id]) }}">
                        @csrf
                        <button type="submit" class="btn btn-danger">Cancelar Projeto</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
