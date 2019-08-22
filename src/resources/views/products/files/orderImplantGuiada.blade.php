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
                    1. Modelos digitais: escaneamento intraoral (preferencialmente) ou modelo de gesso obtidos por
                    modelagem com silicone de adição digitalizados.
                </label>
                <br/><br/>

                @include('products.files.singleFileUpload', ['order' => $order, 'id' => 'file_escaneamento_intraoral_mandibula', 'label' => 'Mandíbula (Obrigatório)', 'presentFiles' => $presentFiles])
                @include('products.files.singleFileUpload', ['order' => $order, 'id' => 'file_escaneamento_intraoral_maxila', 'label' => 'Maxila (Obrigatório)', 'presentFiles' => $presentFiles])
                @include('products.files.singleFileUpload', ['order' => $order, 'id' => 'file_escaneamento_intraoral_registro_mordida', 'label' => 'Registro de Mordida', 'presentFiles' => $presentFiles])

                <br/><br/>
                <label>
                    2. Tomografia computadorizada Cone Beam com a boca entreaberta.
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
