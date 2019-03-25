@foreach(config('menus.main') as $item)
    @if(!isset($item['condition']) || $item['condition']())
        <li class="{{ Route::currentRouteName() == $item['route'] ? 'active' : '' }}">
            <a href="{{ route($item['route']) }}"><em class="{{ $item['icon']  }}">&nbsp;</em> {{ $item['label'] }}</a>
        </li>
    @endif
@endforeach
<li><a href="#"><em class="fa fa-calendar-check-o">&nbsp;</em> Solicitar Scan Service</a></li>
<li><a href="#"><em class="fa fa-desktop">&nbsp;</em> STL</a></li>
<li><a href="#"><em class="fa fa-users">&nbsp;</em> Pacientes</a></li>
@if(Auth::user()->role == 'clinica')
    <li><a href="#"><em class="fa fa-user-md">&nbsp;</em> Dentistas</a></li>
@endif
<li><a href="#"><em class="fa fa-phone">&nbsp;</em> Abrir chamado</a></li>
