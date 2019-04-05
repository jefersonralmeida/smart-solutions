@can ('view-dashboard')
    <li><a href="{{ route('home') }}"><em class="fa fa-dashboard">&nbsp;</em> Painel</a></li>
@endcan

<li><a href="{{ route('profile') }}"><em class="fa fa-user">&nbsp;</em> Dados Cadastrais</a></li>

@can ('view-orders')
    <li><a href="{{ route('orders') }}"><em class="fa fa-shopping-cart">&nbsp;</em> Pedidos</a></li>
@endcan

@can ('place-orders')
    <li><a href="{{ route('order-aligner') }}"><em class="fa fa-paper-plane">&nbsp;</em> Solicitar Aligner</a></li>
    <li><a href="#"><em class="fa fa-calendar-check-o">&nbsp;</em> Solicitar Scan Service</a></li>
    <li><a href="#"><em class="fa fa-desktop">&nbsp;</em> STL</a></li>
@endcan

@can ('view-patients')
    <li><a href="#"><em class="fa fa-users">&nbsp;</em> Pacientes</a></li>
@endcan

@can ('view-dentists')
    <li><a href="{{ route('dentists') }}"><em class="fa fa-user-md">&nbsp;</em> Dentistas</a></li>
@endcan
<!-- <li><a href="#"><em class="fa fa-phone">&nbsp;</em> Abrir chamado</a></li> -->
