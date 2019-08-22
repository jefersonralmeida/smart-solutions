<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @if(request()->getHost() == config('domains.alignerDomain'))
        <title>Smart Aligner - Painel de Controle</title>
    @else
        <title>Smart Solutions - Painel de Controle</title>
    @endif
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/datepicker3.css') }}" rel="stylesheet">
    <link href="{{ asset('css/styles_' . (request()->getHost() == config('domains.alignerDomain') ? 'aligner' : 'solutions') .'.css') }}" rel="stylesheet">

    <script>
        const userId = "{{ Auth::user()->id }}";
        const apiToken = "{{Auth::user()->api_token}}";
    </script>

    <script src="{{ asset('js/app.js') }}" defer></script>

    <link href="https://fonts.googleapis.com/css?family=Aldrich|Nova+Square|Parisienne&display=swap" rel="stylesheet">

    <!--Custom Font-->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i"
          rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->

    <style>
        .progress {
            position: relative;
            width: 100%;
            height: 30px;
            border: 1px solid #7F98B2;
            padding: 1px;
            border-radius: 3px;
        }

        .bar {
            background-color: #B4F5B4;
            width: 0%;
            height: 30px;
            border-radius: 3px;
        }

        .percent {
            position: absolute;
            display: inline-block;
            top: 3px;
            left: 48%;
            color: #7F98B2;
        }
    </style>
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
            <a class="navbar-brand" href="#"><img src="{{ asset('images/smart-' . (request()->getHost() == config('domains.alignerDomain') ? 'aligner' : 'solutions') .'-logo.png') }}"
                                                  class="img-responsive"/></a>
            <ul class="nav navbar-top-links navbar-right">
                @include('layouts.notifications')
            </ul>
        </div>
    </div><!-- /.container-fluid -->
</nav>
<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
    <div class="profile-sidebar">
        <div class="profile-userpic">
            <img src="{{ route('profile.avatar', ['size' => 'small']) }}" class="img-responsive" alt="">
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
                    <li><a href="{{ route($breadcrumb['route']) }}">{{ $breadcrumb['label'] }}</a></li>
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
<script src="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/jquery.maskedinput/1.4.1/jquery.maskedinput.min.js') }}"></script>
@yield('scripts')

{{--File uploader script--}}
<script src="http://malsup.github.com/jquery.form.js"></script>
<script language="javascript">

    let bindProgressBar = function (field) {
        console.log(field);
        let bar = field.find('.bar');
        let percent = field.find('.percent');

        field.ajaxForm({
            beforeSend: function () {
                let percentVal = '0%';
                bar.width(percentVal);
                bar.css('backgroundColor', '#B4F5B4');
                percent.css('left', '42%');
                percent.html(percentVal);
            },
            uploadProgress: function (event, position, total, percentComplete) {
                let percentVal = percentComplete + '%';
                bar.width(percentVal)
                percent.html(percentVal);
            },
            success: function () {
                percent.css('left', '35%');
                percent.html('Arquivo enviado com sucesso.');
            },
            error: function () {
                bar.css('backgroundColor', '#fbb');
                percent.css('left', '35%');
                percent.html('Falha ao enviar o arquivo.');
            }
        });
    };
    $('form.file-upload-form').each(function () {
        bindProgressBar($(this));
    });

    $('.multiple-file-uploader .add-file').on('click', function (e) {
        e.preventDefault();
        let container = $(this).parent('.multiple-file-uploader');
        let hidden = container.find('.single-file-uploader:hidden');
        hidden.first().show();
        if (hidden.length == 1) {
            $(this).hide();
        }
        container.find('.remove-file').show();
    });

    $('.multiple-file-uploader .remove-file').on('click', function (e) {
        e.preventDefault();
        let container = $(this).parent('.multiple-file-uploader');
        let visible = container.find('.single-file-uploader:visible')
        visible.last().hide();
        if (visible.length == 2) {
            $(this).hide();
        }
        container.find('.add-file').show();
    });
</script>



</body>
</html>
