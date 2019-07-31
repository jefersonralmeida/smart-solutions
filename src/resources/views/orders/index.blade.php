@php
    /** @var \App\Order[]|\Illuminate\Database\Eloquent\Collection $orders */
@endphp
@extends('layouts.main')

@section('content')

    @include('layouts.flash-message')

    @include('orders.index.searchBox', compact($patients, $dentists))

    <div class="row">
        @foreach($orders as $order)
        <div class="col-md-12">
            <div class="panel panel-default ">
                <div class="panel-heading" style="background-color: {{ $order->status_color }}">
                    {{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }} - {{ $order->product_name }} - {{ $order->patient->name }}&nbsp;
                    <a href="{{ $order->status_next_route }}">{{ $order->status_next_label }}</a>
                    <span class="pull-right clickable panel-toggle panel-button-tab-left"><em class="fa fa-toggle-up"></em></span>
                </div>
                @include('orders.index.timeLineBox' , ['order' => $order])
            </div>
        </div><!--/.col-->
        @endforeach
        @if($orders->isEmpty())
        <div class="col-md-12">
            <p>Nenhum pedido encontrado.</p>
        </div>
        @endif
    </div><!--/.row-->
@endsection
