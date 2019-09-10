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
                    <div class="panel-body" style="background-color: #D8DDE7">
                        <strong>
                            {{ str_pad($order->id, 4, '0', STR_PAD_LEFT) }} - {{ $order->product_name }}
                            - {{ $order->patient->name }}&nbsp;
                        </strong>
                        <p>
                            <strong>Status:</strong> {{ $order->status_desc }}
                            @if($order->integration_id)
                                | OS-{{ $order->integration_id }}
                            @endif
                            @if(!empty($order->status_next_label))
                                | <a href="{{ $order->status_next_route }}">{{ $order->status_next_label }}</a>
                            @endif
                        </p>
                    </div>
                    <div class="panel-body">
                        @include('orders.index.timeLineBox' , ['order' => $order])
                    </div>
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
