@php
    /** @var \App\Patient[]|\Illuminate\Database\Eloquent\Collection $patients */
    /** @var \App\Dentist[]|\Illuminate\Database\Eloquent\Collection $dentists */
@endphp
@extends('layouts.main')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">Preencha os dados para solicitar.</div>
        <form method="POST" action="{{ route('order-esthetic.store') }}" enctype="multipart/form-data">
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

                    <label>1 - PLANEJAMENTO DESEJADO</label>
                </div>
                <div class="col-md-12">
                    <div class="radio">
                        <label>
                            <input
                                    type="radio"
                                    name="data[planejamento]"
                                    value="1"
                                    checked
                            >DSD 2D
                        </label>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="radio">
                        <label>
                            <input
                                    type="radio"
                                    name="data[planejamento]"
                                    value="2"
                                    {{ old('data')['planejamento'] == 2 ? 'checked' : '' }}
                            >DSD 2D + 3D (Enceramento virtual)
                        </label>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="radio">
                        <label>
                            <input
                                    type="radio"
                                    name="data[planejamento]"
                                    value="3"
                                    {{ old('data')['planejamento'] == 3 ? 'checked' : '' }}
                            >Smart Plan Trauma e Reconstruction
                        </label>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="radio">
                        <label>
                            <input
                                    type="radio"
                                    name="data[planejamento]"
                                    value="4"
                                    {{ old('data')['planejamento'] == 4 ? 'checked' : '' }}
                            >Perio guide
                        </label>
                    </div>
                </div>

                <div class="col-md-12">
                    <hr/>
                </div>

                <div class="col-md-12"><label>2 - MARQUE OS ELEMENTOS A SEREM PLANEJADOS</label></div>

                @include('products.teethBox', ['fieldName' => 'elementos_planejados'])

                <div class="col-md-12">
                    <hr/>
                </div>
                <div class="col-md-12">
                    <label>
                        3 - OUTRAS INFORMAÇÕES IMPORTANTES PARA REALIZAÇÃO DO SETUP
                    </label>
                    <textarea class="form-control" name="data[observacoes]" rows="3"></textarea>
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
                        5 - ENVIAR ARQUIVOS<br/>

                    </label>
                    <br/><br/>
                    <label>
                        1. Modelos digitais: escaneamento intraoral (preferencialmente) ou modelos de gesso obtidos por moldagem com silicone de adição digitalizados.
                    </label>
                    <input type="file" name="file_modelos_digitais">
                    <br/><br/>
                    <label>
                        2. Fotografia central de Face
                    </label>
                    <input type="file" name="file_foto_central_face">
                    <br/><br/>
                    <label>
                        3. Fotografia central de Face sorrindo
                    </label>
                    <input type="file" name="file_foto_central_face_sorrindo">
                    <br/><br/>
                    <label>
                        4. Fotografia central de Face com afastador labial.
                    </label>
                    <input type="file" name="file_foto_central_face_afastador">
                    <br/><br/>
                    <label>
                        5. Fotografia de Perfil de Face em repouso
                    </label>
                    <input type="file" name="file_foto_perfil_face_repouso">
                    <br/><br/>
                    <label>
                        6. Fotografia de Perfil de Face sorrindo sem afastar os dentes
                    </label>
                    <input type="file" name="file_foto_perfil_face_sorrindo">
                    <br/><br/>
                    <label>
                        7. Fotografia 12 horas
                    </label>
                    <input type="file" name="file_foto_12_horas">
                    <br/><br/>
                    <label>
                        8. Vídeo Frontal do Paciente respondendo algumas perguntas.
                    </label>
                    <input type="file" name="file_video_frontal">
                    <br/><br/>
                    <label>
                        9. Vídeo Aproximado do Sorriso do Paciente - Movimentos: Mastigação
                    </label>
                    <input type="file" name="file_video_aproximado_mastigacao">
                    <br/><br/>
                    <label>
                        10. Protusão e de Lateralidade (Guia Canina)
                    </label>
                    <input type="file" name="file_protusao_lateralidade">
                    <br/><br/>
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
        const restricaoMovimentoDentarioRadio = $('#restricao_movimento_dentario_radio input[type=radio][name=restricao_movimento_dentario]');
        const restricaoMovimentoDentarioBox = $('#restricao_movimento_dentario_box');
        restricaoMovimentoDentarioRadio.change(function () {
            if ($(this).val() === '0') {
                restricaoMovimentoDentarioBox.hide();
            } else {
                restricaoMovimentoDentarioBox.show();
            }
        });

        const attachmentsRadio = $('#attachments_radio input[type=radio][name=attachments]');
        const attachmentsBox = $('#attachments_box');
        attachmentsRadio.change(function () {
            if ($(this).val() === '0') {
                attachmentsBox.hide();
            } else {
                attachmentsBox.show();
            }
        });

        $('#sobrecorrecoes_rotacoes_radio input[type=radio]').on('change', function () {
            if ($(this).val() == 2) {
                $('#sobrecorrecoes_rotacoes_dentes').prop('disabled', false);
            } else {
                $('#sobrecorrecoes_rotacoes_dentes').prop('disabled', true);
            }
        });

        $('#sobrecorrecoes_intrusoes_radio input[type=radio]').on('change', function () {
            if ($(this).val() == 2) {
                $('#sobrecorrecoes_intrusoes_dentes').prop('disabled', false);
            } else {
                $('#sobrecorrecoes_intrusoes_dentes').prop('disabled', true);
            }
        });

        $('#sobrecorrecoes_extrusoes_radio input[type=radio]').on('change', function () {
            if ($(this).val() == 2) {
                $('#sobrecorrecoes_extrusoes_dentes').prop('disabled', false);
            } else {
                $('#sobrecorrecoes_extrusoes_dentes').prop('disabled', true);
            }
        });

        $('input[type=radio][name="data[nivelamento_incisivos_superiores][opcao]"]').on('change', function () {
            if ($(this).val() == 1) {
                $('#nivelamento_incisivos_superiores_box1 input[type=radio]').prop('disabled', false);
                $('#nivelamento_incisivos_superiores_box2 input').prop('disabled', true);
                if ($('#nivelamento_incisivos_superiores_box1 input[type=radio][value="3"]').prop('checked')) {
                    $('#nivelamento_incisivos_superiores_outra_orientacao_1').prop('disabled', false);
                }
            } else {
                $('#nivelamento_incisivos_superiores_box1 input').prop('disabled', true);
                $('#nivelamento_incisivos_superiores_box2 input[type=radio]').prop('disabled', false);
                if ($('#nivelamento_incisivos_superiores_box2 input[type=radio][value="3"]').prop('checked')) {
                    $('#nivelamento_incisivos_superiores_outra_orientacao_2').prop('disabled', false);
                }
            }
        });

        $('input[type=radio][name="data[nivelamento_incisivos_superiores][detalhe1]"]').on('change', function () {
            if ($(this).val() == 3) {
                $('#nivelamento_incisivos_superiores_outra_orientacao_1').prop('disabled', false);
            } else {
                $('#nivelamento_incisivos_superiores_outra_orientacao_1').prop('disabled', true);
            }
        });

        $('input[type=radio][name="data[nivelamento_incisivos_superiores][detalhe2]"]').on('change', function () {
            if ($(this).val() == 3) {
                $('#nivelamento_incisivos_superiores_outra_orientacao_2').prop('disabled', false);
            } else {
                $('#nivelamento_incisivos_superiores_outra_orientacao_2').prop('disabled', true);
            }
        });

        $('input[type=radio][name="data[envio_modelo_fisico]"]').on('change', function () {
            if ($(this).val() == 1) {
                $('input[type=radio][name="data[destino_modelo_fisico]"]').prop('disabled', false);
            } else {
                $('input[type=radio][name="data[destino_modelo_fisico]"]').prop('disabled', true);
            }
        });

        $('input[type=radio][name="data[scan_service]"]').on('change', function () {
            if ($(this).val() == 1) {
                $('input[type=file][name="file_scan_service"]').prop('disabled', false);
            } else {
                $('input[type=file][name="file_scan_service"]').prop('disabled', true);
            }
        });

        $('input[type=radio][name="data[diastemas][opcoes]"]').on('change', function () {
            if ($(this).val() == 2) {
                $('input[name="data[diastemas][exceto]"]').prop('disabled', false);
            } else {
                $('input[name="data[diastemas][exceto]"]').prop('disabled', true);
            }
        });

        $('input[type=radio][name="data[linha_media][opcoes]"]').on('change', function () {
            if ($(this).val() == 3) {
                $('select[name="data[linha_media][superior]"]').prop('disabled', false);
                $('select[name="data[linha_media][inferior]"]').prop('disabled', false);
            } else {
                $('select[name="data[linha_media][superior]"]').prop('disabled', true);
                $('select[name="data[linha_media][inferior]"]').prop('disabled', true);
            }
        });

    </script>
@endsection