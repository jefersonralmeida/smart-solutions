@php
    /** @var \App\Order $order */
    /** @var string[] $presentFiles */
@endphp
@extends('layouts.main')

@section('content')
    @include('layouts.flash-message')
    <div class="panel panel-default">
        <div class="panel-heading">Selecione os arquivos a serem enviados</div>
        <div class="panel-body">

            <div class="col-md-12">
                <label>
                    1. Tomografia computadorizada Cone Beam
                </label>
                <br/><br/>
                @include('products.files.multipleFileUpload', ['order' => $order, 'id' => 'file_tomografia_computadorizada_cone_bean', 'presentFiles' => $presentFiles])
                <br/><br/>
            </div>
            <div class="col-md-12">
                <hr/>
            </div>
            <div class="col-md-12">
                <form action="{{ route('orders.finish', [$order->id]) }}" method="POST">
                    @csrf
                    <button class="btn btn-primary">Finalizar Pedido</button>
                </form>
            </div>
        </div><!-- /.panel-->
    </div>
@endsection
