@php
    /** @var \App\Patient[]|\Illuminate\Database\Eloquent\Collection $patients */
    /** @var \App\Dentist[]|\Illuminate\Database\Eloquent\Collection $dentists */
@endphp
@extends('layouts.main')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">Preencha os dados para solicitar.</div>
        <form method="POST" action="{{ route('order-implant-guiada.store') }}" enctype="multipart/form-data">
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

                    <label>1 - GUIA DESEJADA</label>
                </div>
                <div class="col-md-12">
                    <div class="radio">
                        <label>
                            <input
                                    type="radio"
                                    name="data[guia_desejada]"
                                    value="1"
                                    checked
                            >Guia Total (Muco Suportado)
                        </label>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="radio">
                        <label>
                            <input
                                    type="radio"
                                    name="data[guia_desejada]"
                                    value="2"
                                    {{ old('data')['guia_desejada'] == 2 ? 'checked' : '' }}
                            >Guia Parcial (Dento Suportado)
                        </label>
                    </div>
                </div>


                <div class="col-md-12">
                    <hr/>
                </div>

                <div class="col-md-12"><label>2 - MARQUE OS ELEMENTOS QUE VÃO RECEBER IMPLANTE<br/>
                        OBSERVAÇÃO: ESSA ETAPA REFERE-SE A QUANTIDADE DE FUROS NO GUIA ESCOLHIDO</label></div>

                @include('products.teethBox', ['fieldName' => 'elementos_implante']);

                <div class="col-md-12">&nbsp;</div>

                <div class="col-md-12"><label>2.1 - Prótese</label></div>

                <div class="col-md-12">
                    <div class="radio">
                        <label>
                            <input
                                    type="radio"
                                    name="data[protese]"
                                    value="1"
                                    checked
                            >Cimentada
                        </label>
                    </div>
                    <div class="radio">
                        <label>
                            <input
                                    type="radio"
                                    name="data[protese]"
                                    value="2"
                                    {{ old('data')['protese'] == 2 ? 'checked' : '' }}
                            >Parafusada
                        </label>
                    </div>

                </div>


                <div class="col-md-12">&nbsp;</div>
                <div class="col-md-12"><label>2.2 - Sistema de implante a ser utilizado</label></div>

                <div class="col-md-12">
                    <div class="radio">
                        <label>
                            <input
                                    type="radio"
                                    name="data[sistema_implante][opcoes]"
                                    value="1"
                                    checked
                            >SIN (HE ou CM)
                        </label>
                    </div>
                    <div class="radio">
                        <label>
                            <input
                                    type="radio"
                                    name="data[sistema_implante][opcoes]"
                                    value="2"
                                    {{ old('data')['sistema_implante']['opcoes'] == '2' ? 'checked' : '' }}
                            >NEODENT (Titamax, Alvim, Drive, Facility ou GM)
                        </label>
                    </div>
                    <div class="radio">
                        <label>
                            <input
                                    type="radio"
                                    name="data[sistema_implante][opcoes]"
                                    value="3"
                                    {{ old('data')['sistema_implante']['opcoes'] == '3' ? 'checked' : '' }}
                            >CONEXÃO (HE, HI ou OM)
                        </label>
                    </div>
                    <div class="radio">
                        <label>
                            <input
                                    type="radio"
                                    name="data[sistema_implante][opcoes]"
                                    value="4"
                                    {{ old('data')['sistema_implante']['opcoes'] == '4' ? 'checked' : '' }}
                            >STRAUMANN (BL, BLT ou Tissue)
                        </label>
                    </div>
                    <div class="radio">
                        <label>
                            <input
                                    type="radio"
                                    name="data[sistema_implante][opcoes]"
                                    value="5"
                                    {{ old('data')['sistema_implante']['opcoes'] == '5' ? 'checked' : '' }}
                            >DERIG (Singular ou Bioneck)
                        </label>
                    </div>
                    <div class="radio">
                        <label>
                            <input
                                    type="radio"
                                    name="data[sistema_implante][opcoes]"
                                    value="6"
                                    {{ old('data')['sistema_implante']['opcoes'] == '6' ? 'checked' : '' }}
                            >EMFILS
                        </label>
                    </div>
                    <div class="radio">
                        <label>
                            <input
                                    type="radio"
                                    name="data[sistema_implante][opcoes]"
                                    value="7"
                                    {{ old('data')['sistema_implante']['opcoes'] == '7' ? 'checked' : '' }}
                            >IMPLACIL
                        </label>
                    </div>
                    <div class="radio">
                        <label>
                            <input
                                    type="radio"
                                    name="data[sistema_implante][opcoes]"
                                    value="8"
                                    {{ old('data')['sistema_implante']['opcoes'] == '8' ? 'checked' : '' }}
                            >OUTRO
                        </label>
                    </div>
                    <input class="form-control" name="data[sistema_implante][outro]"
                           placeholder="Descreva o sistema de implante">

                </div>

                <div class="col-md-12">&nbsp;</div>

                <div class="col-md-12"><label>2.2.1 - Descreva o modelo do implante.</label></div>
                <div class="col-md-12">
                    <input class="form-control" name="data[modelo_implante]"
                           placeholder="Descreva o modelo do implante">
                </div>

                <div class="col-md-12">&nbsp;</div>

                <div class="col-md-12"><label>2.2 - Exodontia</label></div>

                @include('products.teethBox', ['fieldName' => 'exodontia']);

                <div class="col-md-12">
                    <hr/>
                </div>

                <div class="col-md-12">
                    <label>
                        3 - OUTRAS INFORMAÇÕES IMPORTANTES PARA REALIZAÇÃO DO PLANEJAMENTO
                    </label>
                    <textarea class="form-control" rows="3" name="data[observacoes]"></textarea>
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

    </script>
@endsection
