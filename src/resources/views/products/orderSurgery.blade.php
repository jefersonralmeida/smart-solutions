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
                    <label>
                        5 - ANEXE AQUI OS ARQUIVOS OBRIGATÓRIOS<br/>

                    </label>
                    <br/><br/>
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
                    <input type="file" name="file_tomografia_computadorizada_cone_bean">
                    <br/><br/>
                    <label>
                        2. Perfil direito e esquerdo com o lábio relaxado
                    </label>
                    <input type="file" name="file_perfil_direito_esquerdo_labio_relaxado_1">
                    <a href="#" class="adicionar_arquivo_complementar" style="margin: 5px 0">Adicionar Arquivo</a>
                    <br/><br/>
                    <label>
                        3. Perfil direito e esquerdo sorrindo
                    </label>
                    <input type="file" name="file_perfil_direito_esquer_sorrindo_1">
                    <a href="#" class="adicionar_arquivo_complementar" style="margin: 5px 0">Adicionar Arquivo</a>
                    <br/><br/>
                    <label>
                        4. Frontal com a boca relaxada
                    </label>
                    <input type="file" name="file_frontal_boca_relaxada">
                    <br/><br/>
                    <label>
                        5. Frontal com a boca levemente aberta
                    </label>
                    <input type="file" name="file_frontal_boca_levemente_aberta">
                    <br/><br/>
                    <label>
                        6. Frontal sorrindo
                    </label>
                    <input type="file" name="file_frontal_sorrindo">
                    <br/><br/>
                    <label>
                        7. Sub-mento vértix boca fechada
                    </label>
                    <input type="file" name="file_sub_mento_vertix_boca_fechada">
                    <br/><br/>
                    <label>
                        8. Sub-mento vértix boca aberta
                    </label>
                    <input type="file" name="file_sub_mento_vertix_boca_aberta">
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
                    <label for="file_modelos_digitalizados_oclusao_inicial_mandibula">Mandíbula</label>
                    <input
                            type="file"
                            id="file_modelos_digitalizados_oclusao_inicial_mandibula"
                            name="file_modelos_digitalizados_oclusao_inicial_mandibula"
                            required
                    />
                    <br/>
                    <label for="file_modelos_digitalizados_oclusao_inicial_maxila">Maxila</label>
                    <input
                            type="file"
                            id="file_modelos_digitalizados_oclusao_inicial_maxila"
                            name="file_modelos_digitalizados_oclusao_inicial_maxila"
                            required
                    />
                    <br/>

                    <label for="file_modelos_digitalizados_oclusao_inicial_registro_mordida">Registro de Mordida</label>
                    <input
                            type="file"
                            id="file_modelos_digitalizados_oclusao_inicial_registro_mordida"
                            name="file_modelos_digitalizados_oclusao_inicial_registro_mordida"
                    />
                    <br/><br/>
                    <label>
                        9.2 Oclusão Final
                    </label>
                    <br/>
                    <label for="file_modelos_digitalizados_oclusao_final_mandibula">Mandíbula</label>
                    <input
                            type="file"
                            id="file_modelos_digitalizados_oclusao_final_mandibula"
                            name="file_modelos_digitalizados_oclusao_final_mandibula"
                            required
                    />
                    <br/>
                    <label for="file_modelos_digitalizados_oclusao_final_maxila">Maxila</label>
                    <input
                            type="file"
                            id="file_modelos_digitalizados_oclusao_final_maxila"
                            name="file_modelos_digitalizados_oclusao_final_maxila"
                            required
                    />
                    <br/>

                    <label for="file_modelos_digitalizados_oclusao_final_registro_mordida">Registro de Mordida</label>
                    <input
                            type="file"
                            id="file_modelos_digitalizados_oclusao_final_registro_mordida"
                            name="file_modelos_digitalizados_oclusao_final_registro_mordida"
                    />

                </div>
                <div class="col-md-12">
                    <hr/>
                </div>

                <div class="col-md-12">
                    <hr/>
                </div>
                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary">Enviar solicitação</button>
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