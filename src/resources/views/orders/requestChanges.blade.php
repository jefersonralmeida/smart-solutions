@php
    /** @var \App\Order $order */
    /** @var \App\Dentist $dentist */
    /** @var \App\Patient $patient */
    /** @var \App\Address[]|\Illuminate\Database\Eloquent\Collection $addresses */
    /** @var array $shippingProviders */
@endphp
@extends('layouts.main')

@section('content')
    <div class="panel panel-default" xmlns="http://www.w3.org/1999/html">
        <div class="panel-body">
            @if ($errors->any())
                <div class="alert bg-warning" role="alert">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{!! $error !!}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
        <form method="post" action="{{ route('orders.requestChanges', $order->id) }}">
            @csrf
            <div class="panel-body">
{{--                <div class="col-lg-12">--}}
{{--                    <h4>Dados do Dentista</h4>--}}
{{--                </div>--}}
{{--                @include ('dentists.cell', ['dentist' => $order->dentist])--}}
{{--                <div class="col-lg-12">--}}
{{--                    <hr/>--}}
{{--                </div>--}}
{{--                <div class="col-lg-12">--}}
{{--                    <h4>Dados do Paciente</h4>--}}
{{--                </div>--}}
{{--                @include ('patients.cell', ['patient' => $order->patient])--}}
{{--                <div class="col-lg-12">--}}
{{--                    <hr/>--}}
{{--                </div>--}}
                <div class="col-lg-12">
                    <h4>Descreva as alterações necessárias:</h4>
                </div>
                <div class="col-lg-12">&nbsp;</div>
                <div class="col-lg-12">
                    <textarea name="changes" style="width: 100%; height: 300px;"></textarea>
                </div>
                <div class="col-lg-12">
                    <hr/>
                </div>
                <div class="col-lg-12">
                    <button type="submit" class="btn btn-success">Solicitar Alterações</button>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('scripts')
    <script language="javascript">

    </script>
@endsection
