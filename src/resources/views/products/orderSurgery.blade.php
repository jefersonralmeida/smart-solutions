@php
    /** @var \App\Patient[]|\Illuminate\Database\Eloquent\Collection $patients */
    /** @var \App\Dentist[]|\Illuminate\Database\Eloquent\Collection $dentists */
@endphp
@extends('layouts.main')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">Preencha os dados para solicitar.</div>
        <form method="POST" action="{{ route('order-surgery.store') }}" enctype="multipart/form-data">
            @csrf
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
                <div class="col-md-12">
                    <hr/>
                </div>
                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary">Enviar solicitação</button>
                    <button type="reset" class="btn btn-default">Resetar formulário</button>
                </div>
                <div class="col-md-12">
                    <hr/>
                </div>

                @include('products.patientDentistBox', [
                    'patients' => $patients,
                    'dentist' => $dentists,
                    'errors' => $errors
                ])

                <div class="col-md-12">&nbsp;</div>
                <div class="col-md-12">

                    <label>1 - TIPO DE CASO<br/>
                        ATENÇÃO: OBRIGATÓRIO SELECIONAR UM TIPO DE CASO ABAIXO</label>
                </div>
                <div class="col-md-12">
                    <div class="radio">
                        <label>
                            <input
                                    type="radio"
                                    name="data[tipo_caso]"
                                    value="1"
                                    checked
                            >Somente Impressão
                        </label>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="radio">
                        <label>
                            <input
                                    type="radio"
                                    name="data[tipo_caso]"
                                    value="2"
                                    {{ old('data')['tipo_caso'] == 2 ? 'checked' : '' }}
                            >Smart Plan
                            Orthognathics
                        </label>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="radio">
                        <label>
                            <input
                                    type="radio"
                                    name="data[tipo_caso]"
                                    value="3"
                                    {{ old('data')['tipo_caso'] == 3 ? 'checked' : '' }}
                            >Smart Plan
                            Trauma e Reconstruction
                        </label>
                    </div>
                </div>

                <div class="col-md-12">
                    <hr/>
                </div>

                <div class="col-md-12 tipo-trabalho"><label>2 - TIPO DE TRABALHO<br/>
                        ATENÇÃO: OBRIGATÓRIO SELECIONAR AO MENOS UM TIPO DE CASO ABAIXO</label></div>

                <div class="col-md-12 tipo-trabalho">
                    <div>&nbsp;</div>
                    <div class="checkbox smart-plan-orthognathics" style="display: none">
                        <label>
                            <input
                                    type="checkbox"
                                    name="data[tipo_trabalho][1]"
                                    value="1"
                            >Pré-montagem de crânio
                        </label>
                    </div>
                    <div class="checkbox smart-plan-orthognathics somente-impressao" style="display: none">
                        <label>
                            <input
                                    type="checkbox"
                                    name="data[tipo_trabalho][2]"
                                    value="1"
                            >Smart Splint intermediário
                        </label>
                    </div>
                    <div class="checkbox smart-plan-orthognathics somente-impressao" style="display: none">
                        <label>
                            <input
                                    type="checkbox"
                                    name="data[tipo_trabalho][3]"
                                    value="1"
                            >Smart Splint final
                        </label>
                    </div>
                    <div class="checkbox smart-plan-orthognathics" style="display: none">
                        <label>
                            <input
                                    type="checkbox"
                                    name="data[tipo_trabalho][4]"
                                    value="1"
                            >Guia de Palato - fina
                        </label>
                    </div>
                    <div class="checkbox smart-plan-orthognathics" style="display: none">
                        <label>
                            <input
                                    type="checkbox"
                                    name="data[tipo_trabalho][5]"
                                    value="1"
                            >Guia de Palato - inteira
                        </label>
                    </div>
                    <div class="checkbox smart-plan-orthognathics" style="display: none">
                        <label>
                            <input
                                    type="checkbox"
                                    name="data[tipo_trabalho][6]"
                                    value="1"
                            >Guia de corte e posicionamento de mento
                        </label>
                    </div>
                    <div class="checkbox smart-plan-orthognathics" style="display: none">
                        <label>
                            <input
                                    type="checkbox"
                                    name="data[tipo_trabalho][7]"
                                    value="1"
                            >Guia Osteoromia de Wings
                        </label>
                    </div>
                    <div class="checkbox smart-plan-orthognathics" style="display: none">
                        <label>
                            <input
                                    type="checkbox"
                                    name="data[tipo_trabalho][8]"
                                    value="1"
                            >Guia de corte - ATM
                        </label>
                    </div>
                    <div class="checkbox smart-plan-orthognathics" style="display: none">
                        <label>
                            <input
                                    type="checkbox"
                                    name="data[tipo_trabalho][9]"
                                    value="1"
                            >Guia L invertido - Avulso
                        </label>
                    </div>
                    <div class="checkbox smart-plan-orthognathics" style="display: none">
                        <label>
                            <input
                                    type="checkbox"
                                    name="data[tipo_trabalho][10]"
                                    value="1"
                            >Guia L invertido - Par
                        </label>
                    </div>
                </div>


                <div class="col-md-12">
                    <hr/>
                </div>


                <div class="col-md-12">
                    <label for="textarea_outras_informacoes">
                        3 - OUTRAS INFORMAÇÕES IMPORTANTES PARA REALIZAÇÃO DO PLANEJAMENTO
                    </label>
                    <textarea
                            class="form-control"
                            rows="3"
                            id="textarea_outras_informacoes"
                            name="data[outras_informacoes]"
                    >
                    </textarea>
                </div>
                <div class="col-md-12">
                    <hr/>
                </div>

                <div class="col-md-12">
                    <label>
                        4 - ENVIO DE MODELO FÍSICO
                    </label>
                    <div class="radio">
                        <label>
                            <input
                                    type="radio"
                                    name="data[envio_modelo_fisico]"
                                    value="1"
                                    {{ (old('data')['envio_modelo_fisico'] ?? 1) == 1 ? 'checked' : '' }}
                            />Sim
                        </label>
                    </div>
                    <div class="radio" style="margin-left: 30px;">
                        <label>
                            <input
                                    type="radio"
                                    name="data[destino_modelo_fisico]"
                                    value="1"
                                    checked
                                    {{ (old('data')['envio_modelo_fisico'] ?? 1) == 1 ? '' : 'disabled' }}
                            />Descarte
                        </label>
                    </div>
                    <div class="radio" style="margin-left: 30px;">
                        <label>
                            <input
                                    type="radio"
                                    name="data[destino_modelo_fisico]"
                                    value="2"
                                    {{ (old('data')['destino_modelo_fisico'] ?? '') == 2 ? 'checked' : '' }}
                                    {{ (old('data')['envio_modelo_fisico'] ?? 1) == 1 ? '' : 'disabled' }}
                            />Devolução
                        </label>
                    </div>
                    <div class="radio">
                        <label>
                            <input
                                    type="radio"
                                    name="data[envio_modelo_fisico]"
                                    value="2"
                                    {{ (old('data')['envio_modelo_fisico'] ?? 1) == 2 ? 'checked' : '' }}
                            />Não
                        </label>
                    </div>
                </div>
                <div class="col-md-12">
                    <hr/>
                </div>
                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary">Ir para envio de arquivos</button>
                    <button type="reset" class="btn btn-default">Resetar formulário</button>
                </div>

            </div><!-- /.panel-->
        </form>
    </div>
@endsection

@section('scripts')
    <script language="javascript">

        $('input[type=radio][name="data[envio_modelo_fisico]"]').on('change', function () {
            if ($(this).val() == 1) {
                $('input[type=radio][name="data[destino_modelo_fisico]"]').prop('disabled', false);
            } else {
                $('input[type=radio][name="data[destino_modelo_fisico]"]').prop('disabled', true);
            }
        });

        const selectCase = function() {
            const caso = $('input[name="data[tipo_caso]"]:checked', 'form').val();
            switch (caso) {
                case '1':
                    $('.tipo-trabalho').hide();
                    $('.tipo-trabalho .checkbox').hide();
                    $('.tipo-trabalho .somente-impressao').show();
                    $('.tipo-trabalho').show();
                    break;
                case '2':
                    $('.tipo-trabalho').hide();
                    $('.tipo-trabalho .checkbox').hide();
                    $('.tipo-trabalho .smart-plan-orthognathics').show();
                    $('.tipo-trabalho').show();
                    break;
                case '3':
                    $('.tipo-trabalho').hide();
                    break;
            }
        };
        selectCase();
        $('form input[name="data[tipo_caso]"]').on('change', selectCase);

        $('.adicionar_arquivo_complementar').on('click', function (e) {
            e.preventDefault();
            let last = $(this).prev('input[type=file]');
            let lastName = last.prop('name');
            let newName = lastName.replace(/\d+$/, (match) => {
                return parseInt(match) + 1;
            });
            last.after(last.clone().prop('name', newName));
        });

    </script>
@endsection
