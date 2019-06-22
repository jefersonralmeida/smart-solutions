@php
    /** @var int $ordersCount */
    /** @var int $patientsCount */
    /** @var array $chartData */
    /** @var \App\Order[] $lastOrders */
@endphp
@extends('layouts.main')

@section('content')
    <div class="panel panel-default">
        <div class="row">
            <div class="col-xs-6 col-md-6 col-lg-6 no-padding">
                <div class="panel panel-teal panel-widget border-right">
                    <div class="row no-padding"><em class="fa fa-xl fa-shopping-cart color-blue"></em>
                        <div class="large">{{ $ordersCount }}</div>
                        <div class="text-muted">PEDIDOS</div>
                    </div>
                </div>
            </div>
            <div class="col-xs-6 col-md-6 col-lg-6 no-padding">
                <div class="panel panel-blue panel-widget border-right">
                    <div class="row no-padding"><em class="fa fa-xl fa-users color-orange"></em>
                        <div class="large">{{ $patientsCount }}</div>
                        <div class="text-muted">PACIENTES</div>
                    </div>
                </div>
            </div>
        </div><!--/.row-->
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Pedidos
                    <span class="pull-right clickable panel-toggle panel-button-tab-left"><em
                                class="fa fa-toggle-up"></em></span></div>
                <div class="panel-body">
                    <div class="canvas-wrapper">
                        <canvas class="main-chart" id="line-chart" height="200" width="600"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div><!--/.row-->

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default ">
                <div class="panel-heading">
                    Últimas compras
                    <span class="pull-right clickable panel-toggle panel-button-tab-left"><em
                                class="fa fa-toggle-up"></em></span></div>
                <div class="panel-body timeline-container">
                    <ul class="timeline">
                        @foreach ($lastOrders as $order)
                            <li>
                                    <a href="{{ route('orders') }}" class="timeline-badge primary"><em
                                                class="glyphicon glyphicon glyphicon-ok"></em>
                                    </a>
                                <div class="timeline-panel">
                                    <div class="timeline-heading">
                                        <h4 class="timeline-title">{{ $order->product_name }}
                                            - {{ $order->created_at->format('d/m/Y') }}</h4>
                                    </div>
                                    <div class="timeline-body">
                                        <p>{{ $order->status_desc }} - {{ $order->patient->name }}</p>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div><!--/.col-->
    </div><!--/.row-->
@endsection

@section('scripts')
    <script>

        var lineChartData = {
            labels: {!! json_encode(array_keys($chartData)) !!},
            datasets: [
                {
                    label: "My Second dataset",
                    fillColor: "rgba(48, 164, 255, 0.2)",
                    strokeColor: "rgba(48, 164, 255, 1)",
                    pointColor: "rgba(48, 164, 255, 1)",
                    pointStrokeColor: "#fff",
                    pointHighlightFill: "#fff",
                    pointHighlightStroke: "rgba(48, 164, 255, 1)",
                    data: {!! json_encode(array_values($chartData)) !!}
                }
            ]

        };
        const chart1 = document.getElementById('line-chart').getContext('2d');
        window.myLine = new Chart(chart1).Line(lineChartData, {
            responsive: true,
            scaleLineColor: 'rgba(0,0,0,.2)',
            scaleGridLineColor: 'rgba(0,0,0,.05)',
            scaleFontColor: '#c5c7cc',
        });

    </script>
@endsection
