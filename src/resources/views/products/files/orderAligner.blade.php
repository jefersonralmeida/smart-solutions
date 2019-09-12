@php
    /** @var \App\Order $order */
    /** @var string[] $presentFiles */
@endphp
@extends('layouts.main')

@section('content')
    @include('layouts.flash-message')
    <div class="panel panel-default">
        <div class="panel-heading">Selecione os arquivos a serem enviados</div>
        <div class="panel-body">

            <div class="col-md-12">
                <label>
                    ANEXE AQUI OS ARQUIVOS OBRIGATÓRIOS<br/>- Modelos digitais por meio de escaneamento
                    intraoral<br/>- Protocolo Fotográfico para planejamento:
                </label>
                <br/><br/>

                @include('products.files.singleFileUpload', ['order' => $order, 'id' => 'file_foto_frontal', 'label' => '1. Foto frontal (Obrigatório)', 'presentFiles' => $presentFiles])
                @include('products.files.singleFileUpload', ['order' => $order, 'id' => 'file_foto_frontal_sorrindo', 'label' => '2. Foto frontal sorrindo (Obrigatório)', 'presentFiles' => $presentFiles])
                @include('products.files.singleFileUpload', ['order' => $order, 'id' => 'file_foto_perfil_direito', 'label' => '3. Foto perfil direito (Obrigatório)', 'presentFiles' => $presentFiles])
                @include('products.files.singleFileUpload', ['order' => $order, 'id' => 'file_foto_oclusal_superior', 'label' => '4. Foto oclusal superior (Obrigatório)', 'presentFiles' => $presentFiles])
                @include('products.files.singleFileUpload', ['order' => $order, 'id' => 'file_foto_oclusal_inferior', 'label' => '5. Foto oclusal inferior (Obrigatório)', 'presentFiles' => $presentFiles])
                @include('products.files.singleFileUpload', ['order' => $order, 'id' => 'file_foto_intrabucal_frontal', 'label' => '6. Foto intrabucal frontal (Obrigatório)', 'presentFiles' => $presentFiles])
                @include('products.files.singleFileUpload', ['order' => $order, 'id' => 'file_foto_intrabucal_lado_direito', 'label' => '7. Foto intrabucal lado direito (Obrigatório)', 'presentFiles' => $presentFiles])
                @include('products.files.singleFileUpload', ['order' => $order, 'id' => 'file_foto_intrabucal_lado_esquerdo', 'label' => '8. Foto intrabucal lado esquerdo (Obrigatório)', 'presentFiles' => $presentFiles])

                <label>
                    9. Arquivos Complementares<br/><br/>
                    Radiografia panorâmica e cefalométrica de perfil ou Tomografia
                    computadorizada Cone Beam
                </label>
                <br/>
                @include('products.files.multipleFileUpload', ['order' => $order, 'id' => 'file_arquivo_complementar', 'presentFiles' => $presentFiles])


                <hr/>
                <label>
                Escaneamento intraoral (.stl):
                </label>
                <br/><br/>
                @include('products.files.singleFileUpload', ['order' => $order, 'id' => 'file_scan_service_mandibula', 'label' => 'Mandíbula (Obrigatório)', 'presentFiles' => $presentFiles])
                @include('products.files.singleFileUpload', ['order' => $order, 'id' => 'file_scan_service_maxila', 'label' => 'Maxila (Obrigatório)', 'presentFiles' => $presentFiles])
                @include('products.files.singleFileUpload', ['order' => $order, 'id' => 'file_scan_service_registro_mordida', 'label' => 'Registro de Mordida', 'presentFiles' => $presentFiles])

{{--                <br/><br/>--}}
{{--                <label>--}}
{{--                    2. Tomografia computadorizada Cone Beam com a boca entreaberta.--}}
{{--                </label>--}}
{{--                <br/><br/>--}}

{{--                @include('products.files.multipleFileUpload', ['order' => $order, 'id' => 'file_tomografia_computadorizada_cone_bean', 'presentFiles' => $presentFiles])--}}
                <br/><br/>
            </div>
            <div class="col-md-12">
                <hr/>
            </div>
            <div class="col-md-12">
                <form action="{{ route('orders.finish', [$order->id]) }}" method="POST">
                    @csrf
                    <button class="btn btn-primary">Finalizar Pedido</button>
                </form>
            </div>
        </div><!-- /.panel-->
    </div>
@endsection
