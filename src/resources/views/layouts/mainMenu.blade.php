@can ('view-dashboard')
    <li><a href="{{ route('home') }}"><em class="fa fa-dashboard">&nbsp;</em> Painel</a></li>
@endcan

<li><a href="{{ route('profile') }}"><em class="fa fa-user">&nbsp;</em> Dados Cadastrais</a></li>

@can ('view-orders')
    <li><a href="{{ route('orders') }}"><em class="fa fa-shopping-cart">&nbsp;</em> Pedidos</a></li>
@endcan

@can ('place-orders')
    @can('domain-aligner')
        <li><a href="{{ route('order-aligner') }}"><em class="fa fa-paper-plane">&nbsp;</em> Solicitar Aligner</a></li>
    @endcan
    @can('domain-solutions')
        <li class="parent">
            <a data-toggle="collapse" href="#sub-item-1">
                <em class="fa fa-paper-plane">&nbsp;</em>Solicitar Implant
                <span data-toggle="collapse" href="#sub-item-1" class="icon pull-right">
                    <em class="fa fa-plus"></em>
                </span>
            </a>
            <ul class="children collapse" id="sub-item-1">
                <li><a href="{{ route('order-implant-guiada') }}"><em class="fa fa-arrow-right">&nbsp;</em> Guiada</a></li>
                <li><a href="{{ route('order-implant-rog') }}"><em class="fa fa-arrow-right">&nbsp;</em> ROG</a></li>
            </ul>
        </li>
        <li><a href="{{ route('order-surgery') }}"><em class="fa fa-paper-plane">&nbsp;</em> Solicitar Surgery</a></li>
        <li><a href="{{ route('order-esthetic') }}"><em class="fa fa-paper-plane">&nbsp;</em> Solicitar Esthetic</a></li>
        {{--<li><a href="{{ route('order-aligner-pp') }}"><em class="fa fa-desktop">&nbsp;</em> Smart Aligner Pre Protese</a></li>--}}
    @endcan
@endcan

@can ('view-patients')
    <li><a href="{{ route('patients') }}"><em class="fa fa-users">&nbsp;</em> Pacientes</a></li>
@endcan

@can ('view-dentists')
    <li><a href="{{ route('dentists') }}"><em class="fa fa-user-md">&nbsp;</em> {{ Auth::user()->clinic->cnpj === null ? 'Dados de Dentista' : 'Dentistas' }}</a></li>
@endcan

@if((Auth::user()->clinic->cnpj ?? null) !== null)
<li><a href="{{ route('clinic.users') }}"><em class="fa fa-user">&nbsp;</em> Usuários</a></li>
@endif

<!-- <li><a href="#"><em class="fa fa-phone">&nbsp;</em> Abrir chamado</a></li> -->
