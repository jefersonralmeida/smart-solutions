@extends('layouts.main')

@section('content')
    <div class="panel panel-default">
        <div class="row">
            <div class="col-xs-6 col-md-6 col-lg-6 no-padding">
                <div class="panel panel-teal panel-widget border-right">
                    <div class="row no-padding"><em class="fa fa-xl fa-shopping-cart color-blue"></em>
                        <div class="large">120</div>
                        <div class="text-muted">PEDIDOS</div>
                    </div>
                </div>
            </div>
            <div class="col-xs-6 col-md-6 col-lg-6 no-padding">
                <div class="panel panel-blue panel-widget border-right">
                    <div class="row no-padding"><em class="fa fa-xl fa-users color-orange"></em>
                        <div class="large">52</div>
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
                    Compras
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
                        <li>
                            <div class="timeline-badge primary"><em class="glyphicon glyphicon glyphicon-ok"></em></div>
                            <div class="timeline-panel">
                                <div class="timeline-heading">
                                    <h4 class="timeline-title">Smart Aligner - 00/00/0000</h4>
                                </div>
                                <div class="timeline-body">
                                    <p>Status da produção - Paciente</p>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="timeline-badge primary"><em class="glyphicon glyphicon glyphicon-file"></em>
                            </div>
                            <div class="timeline-panel">
                                <div class="timeline-heading">
                                    <h4 class="timeline-title">Smart Aligner - 00/00/0000</h4>
                                </div>
                                <div class="timeline-body">
                                    <p>Status da produção - Paciente</p>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="timeline-badge primary"><em class="glyphicon glyphicon glyphicon-wrench"></em>
                            </div>
                            <div class="timeline-panel">
                                <div class="timeline-heading">
                                    <h4 class="timeline-title">Smart Aligner - 00/00/0000</h4>
                                </div>
                                <div class="timeline-body">
                                    <p>Status da produção - Paciente</p>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="timeline-badge primary"><em class="glyphicon glyphicon glyphicon-wrench"></em>
                            </div>
                            <div class="timeline-panel">
                                <div class="timeline-heading">
                                    <h4 class="timeline-title">Smart Aligner - 00/00/0000</h4>
                                </div>
                                <div class="timeline-body">
                                    <p>Status da produção - Paciente</p>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div><!--/.col-->
    </div><!--/.row-->
@endsection
