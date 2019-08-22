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
                    1. Tomografia Computadorizada Cone Beam<br/>
                    • Cortes com espessura menor que 1mm<br/>
                    • FOV (Field of View) incluindo o máximo de estruturas possíveis (osso hióide até a
                    glabela)<br/>
                    • Deve ser feita sem qualquer posicionador de cabeça que possa interferir no tecido mole do
                    paciente<br/>
                    • Paciente com a boca levemente aberta (registro interoclusal em relação cêntrica)<br/>
                    Caso exista área doadora de enxerto autólogo (exemplo ilíaco) a tomografia dessa região deve ser
                    feita. (somente traumas e
                    reconstruções).<br/>
                </label>
                <br/>
                @include('products.files.multipleFileUpload', ['order' => $order, 'id' => 'file_tomografia_computadorizada_cone_bean', 'presentFiles' => $presentFiles])
                <br/><br/>

                <label>
                    2. Perfil direito e esquerdo com o lábio relaxado
                </label>
                <br/>
                @include('products.files.multipleFileUpload', ['order' => $order, 'id' => 'file_perfil_direito_esquerdo_labio_relaxado', 'presentFiles' => $presentFiles])
                <br/><br/>

                <label>
                    3. Perfil direito e esquerdo sorrindo
                </label>
                <br/>
                @include('products.files.multipleFileUpload', ['order' => $order, 'id' => 'file_perfil_direito_esquerdo_sorrindo', 'presentFiles' => $presentFiles])
                <br/><br/>

                <label>
                    4. Frontal com a boca relaxada
                </label>
                <br/>
                @include('products.files.multipleFileUpload', ['order' => $order, 'id' => 'file_frontal_boca_relaxada', 'presentFiles' => $presentFiles])
                <br/><br/>

                <label>
                    5. Frontal com a boca levemente aberta
                </label>
                <br/>
                @include('products.files.multipleFileUpload', ['order' => $order, 'id' => 'file_frontal_boca_levemente_aberta', 'presentFiles' => $presentFiles])
                <br/><br/>

                <label>
                    6. Frontal sorrindo
                </label>
                <br/>
                @include('products.files.multipleFileUpload', ['order' => $order, 'id' => 'file_frontal_sorrindo', 'presentFiles' => $presentFiles])
                <br/><br/>

                <label>
                    7. Sub-mento vértix boca fechada
                </label>
                <br/>
                @include('products.files.multipleFileUpload', ['order' => $order, 'id' => 'file_sub_mento_vertix_boca_fechada', 'presentFiles' => $presentFiles])
                <br/><br/>

                <label>
                    8. Sub-mento vértix boca aberta
                </label>
                <br/>
                @include('products.files.multipleFileUpload', ['order' => $order, 'id' => 'file_sub_mento_vertix_boca_aberta', 'presentFiles' => $presentFiles])
                <br/><br/>

                <label>
                    9. Modelos Digitalizados<br/>
                    • Moldagem com o máximo de cervical possível<br/>
                    • Modelo superior e inferior com registro da oclusão inicial e marcações na oclusão final<br/>
                    • Digitalização dos modelos em oclusão inicial e final<br/>
                    OBS: recomenda-se que os modelos sejam enviados pelo Cirurgião dentista<br/>
                </label>
                <br/><br/>

                <label>
                    9.1 Oclusão Inicial
                </label>
                <br/>
                @include('products.files.singleFileUpload', ['order' => $order, 'id' => 'file_modelos_digitalizados_oclusao_inicial_mandibula', 'label' => 'Mandíbula (Obrigatório)', 'presentFiles' => $presentFiles])
                @include('products.files.singleFileUpload', ['order' => $order, 'id' => 'file_modelos_digitalizados_oclusao_inicial_maxila', 'label' => 'Maxila (Obrigatório)', 'presentFiles' => $presentFiles])
                @include('products.files.singleFileUpload', ['order' => $order, 'id' => 'file_modelos_digitalizados_oclusao_inicial_registro_mordida', 'label' => 'Registro de Mordida', 'presentFiles' => $presentFiles])
                <br/><br/>

                <label>
                    9.1 Oclusão Inicial
                </label>
                <br/>
                @include('products.files.singleFileUpload', ['order' => $order, 'id' => 'file_modelos_digitalizados_oclusao_final_mandibula', 'label' => 'Mandíbula (Obrigatório)', 'presentFiles' => $presentFiles])
                @include('products.files.singleFileUpload', ['order' => $order, 'id' => 'file_modelos_digitalizados_oclusao_final_maxila', 'label' => 'Maxila (Obrigatório)', 'presentFiles' => $presentFiles])
                @include('products.files.singleFileUpload', ['order' => $order, 'id' => 'file_modelos_digitalizados_oclusao_final_registro_mordida', 'label' => 'Registro de Mordida', 'presentFiles' => $presentFiles])
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
