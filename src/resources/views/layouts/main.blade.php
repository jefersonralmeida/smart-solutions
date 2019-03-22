<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Smart Aligner - Painel de Controle</title>
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/datepicker3.css') }}" rel="stylesheet">
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">

    <!--Custom Font-->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i"
          rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<nav class="navbar navbar-custom navbar-fixed-top" role="navigation">
    <div class="container-fluid" style="background-color: #d8dde7;">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#sidebar-collapse"><span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span></button>
            <a class="navbar-brand" href="#"><img src="{{ asset('images/smart-aligner-logo.png') }}" class="img-responsive"/></a>
            <ul class="nav navbar-top-links navbar-right">

                <li class="dropdown"><a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
                        <em class="fa fa-bell"></em><span class="label label-info">3</span>
                    </a>
                    <ul class="dropdown-menu dropdown-alerts">
                        <li><a href="#">
                                <div> Pedido 000000 - Smart Aligner
                                    <span class="pull-right text-muted small">00/00/0000</span></div>
                            </a></li>
                        <li class="divider"></li>
                        <li><a href="#">
                                <div> Pedido 000000 - Smart Aligner
                                    <span class="pull-right text-muted small">00/00/0000</span></div>
                            </a></li>
                        <li class="divider"></li>
                        <li><a href="#">
                                <div> Pedido 000000 - Smart Aligner
                                    <span class="pull-right text-muted small">00/00/0000</span></div>
                            </a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div><!-- /.container-fluid -->
</nav>
<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
    <div class="profile-sidebar">
        <div class="profile-userpic">
            <img src="http://placehold.it/50/30a5ff/fff" class="img-responsive" alt="">
        </div>
        <div class="profile-usertitle">
            <div class="profile-usertitle-name">{{ Auth::user()->name }}</div>
            <div class="profile-usertitle-status">{{ Auth::user()->role }}</div>
        </div>
        <div class="clear"></div>
    </div>
    <div class="divider"></div>
    <ul class="nav menu">
        @include('layouts.mainMenu')
        <li>
            <a href="{{ route('logout') }}"
               onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
            >
                <em class="fa fa-power-off">&nbsp;</em> Sair
            </a>
        </li>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </ul>
</div><!--/.sidebar-->

<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="{{ route('home') }}"><em class="fa fa-home"></em></a></li>
            @foreach(($breadcrumbs ?? []) as $breadcrumb)
                @if(!isset($breadcrumb['route']))
                    <li class="active">{{ $breadcrumb['label'] }}</li>
                @else
                    <li><a href="{{ $breadcrumb['route'] }}">{{ $breadcrumb['label'] }}</a></li>
                @endif
            @endforeach
        </ol>
    </div><!--/.row-->
    @yield('content')
</div>    <!--/.main-->

<script src="{{ asset('js/jquery-1.11.1.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.min.js') }}"></script>
<script src="{{ asset('js/chart.min.js') }}"></script>
<script src="{{ asset('js/chart-data.js') }}"></script>
<script src="{{ asset('js/easypiechart.js') }}"></script>
<script src="{{ asset('js/easypiechart-data.js') }}"></script>
<script src="{{ asset('js/bootstrap-datepicker.js') }}"></script>
<script src="{{ asset('js/custom.js') }}"></script>
<script>
  window.onload = function () {
    var chart1 = document.getElementById('line-chart').getContext('2d');
    window.myLine = new Chart(chart1).Line(lineChartData, {
      responsive: true,
      scaleLineColor: 'rgba(0,0,0,.2)',
      scaleGridLineColor: 'rgba(0,0,0,.05)',
      scaleFontColor: '#c5c7cc',
    });
  };
</script>

</body>
</html>
