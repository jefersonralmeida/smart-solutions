@php
    /** @var \App\Patient[]|\Illuminate\Database\Eloquent\Collection $patients */
    /** @var \App\Dentist[]|\Illuminate\Database\Eloquent\Collection $dentists */
    /** @var \Illuminate\Support\ViewErrorBag $errors */
@endphp
@extends('layouts.main')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">Preencha os dados para solicitar.</div>
        <form method="POST" action="{{ route('order-aligner.store') }}" enctype="multipart/form-data">
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

                <div id="collapsible-form">
                    <div class="col-md-12">
                        <div class="radio">
                            <label for="tratamento_pre_protetico">
                                <input type="checkbox" name="tratamento_pre_protetico" id="tratamento_pre_protetico">
                                Este caso se trata de um tratamento pré-protético.
                            </label>
                        </div>
                    </div>
                    <div class="col-md-12">&nbsp;</div>
                    <div class="col-md-12">

                        <label>1 - CONDIÇÕES CLÍNICAS GERAIS</label>
                    </div>
                    <div class="form-group">
                        <div class="col-md-3">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox"
                                           name="data[condicoes_clinicas_gerais][1]" {{ isset(old('data')['condicoes_clinicas_gerais'][1]) ? 'checked' : '' }}>Apinhamento
                                </label>
                            </div>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox"
                                           name="data[condicoes_clinicas_gerais][2]" {{ isset(old('data')['condicoes_clinicas_gerais'][2]) ? 'checked' : '' }}>Diastemas
                                </label>
                            </div>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox"
                                           name="data[condicoes_clinicas_gerais][3]" {{ isset(old('data')['condicoes_clinicas_gerais'][3]) ? 'checked' : '' }}>Incisivos
                                    vestibularizados
                                </label>
                            </div>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox"
                                           name="data[condicoes_clinicas_gerais][4]" {{ isset(old('data')['condicoes_clinicas_gerais'][4]) ? 'checked' : '' }}>Incisivos
                                    retroinclinados
                                </label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox"
                                           name="data[condicoes_clinicas_gerais][5]" {{ isset(old('data')['condicoes_clinicas_gerais'][5]) ? 'checked' : '' }}>Mordida
                                    cruzada anterior
                                </label>
                            </div>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox"
                                           name="data[condicoes_clinicas_gerais][6]" {{ isset(old('data')['condicoes_clinicas_gerais'][6]) ? 'checked' : '' }}>Mordida
                                    cruzada posterior
                                </label>
                            </div>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox"
                                           name="data[condicoes_clinicas_gerais][7]" {{ isset(old('data')['condicoes_clinicas_gerais'][7]) ? 'checked' : '' }}>Classe
                                    II 1ª divisão
                                </label>
                            </div>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox"
                                           name="data[condicoes_clinicas_gerais][8]" {{ isset(old('data')['condicoes_clinicas_gerais'][8]) ? 'checked' : '' }}>Classe
                                    II 2ª divisão
                                </label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox"
                                           name="data[condicoes_clinicas_gerais][9]" {{ isset(old('data')['condicoes_clinicas_gerais'][9]) ? 'checked' : '' }}>Classe
                                    II
                                </label>
                            </div>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox"
                                           name="data[condicoes_clinicas_gerais][10]" {{ isset(old('data')['condicoes_clinicas_gerais'][10]) ? 'checked' : '' }}>Sobressalência
                                    exagerada
                                </label>
                            </div>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox"
                                           name="data[condicoes_clinicas_gerais][11]" {{ isset(old('data')['condicoes_clinicas_gerais'][11]) ? 'checked' : '' }}>Sobre
                                    mordida exagerada
                                </label>
                            </div>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox"
                                           name="data[condicoes_clinicas_gerais][12]" {{ isset(old('data')['condicoes_clinicas_gerais'][12]) ? 'checked' : '' }}>Mordida
                                    aberta anterior
                                </label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox"
                                           name="data[condicoes_clinicas_gerais][13]" {{ isset(old('data')['condicoes_clinicas_gerais'][13]) ? 'checked' : '' }}>Arco
                                    atrésico
                                </label>
                            </div>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox"
                                           name="data[condicoes_clinicas_gerais][14]" {{ isset(old('data')['condicoes_clinicas_gerais'][14]) ? 'checked' : '' }}>Desvio
                                    de linha média
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">Observações clínicas atuais do paciente<br/>
                        (limitação periodontal, reabsorções radiculares, perfil aceita retrusão ou protrusão de
                        incisivos,
                        etc.)<br/><br/></div>
                    <div class="col-md-6">
                    <textarea class="form-control" rows="3" name="data[observacoes_clinicas_gerais]"
                              placeholder="Preencher com toda informação que possa ser importante para seu caso."
                    >{{ old('data')['observacoes_clinicas_gerais'] ?? '' }}</textarea>
                    </div>
                    <div class="col-md-6">
                    <textarea class="form-control" rows="3" name="data[observacoes_clinicas_objetivos]"
                              placeholder="Objetivo principal e planejamento geral do caso clínico (por favor, forneça o máximo de informação sobre o que se deseja com o tratamento)."
                    >{{ old('data')['observacoes_clinicas_objetivos'] ?? '' }}</textarea>
                        <small class="form-text text-danger">
                            {{ $errors->first('data.observacoes_clinicas_objetivos') }}
                        </small>
                    </div>
                    <div class="col-md-12">
                        <hr/>
                    </div>

                    <div class="col-md-12"><label>2 - SELECIONAR A FORMA DE TRATAMENTO DOS ARCOS</label></div>

                    <div class="form-group">
                        <div class="col-md-6">
                            <label>Arcada superior será:</label>
                            <select class="form-control" name="data[tratamento_arcada_superior]">
                                <option value="">SELECIONE</option>
                                <option
                                    value="1" {{ old('data')['tratamento_arcada_superior'] == 1 ? 'selected' : '' }}>
                                    Tratada com alinhador (má oclusão será corrigida)
                                </option>
                                <option
                                    value="2" {{ old('data')['tratamento_arcada_superior'] == 2 ? 'selected' : '' }}>
                                    Tratada com ortodontia fixa (má oclusão será corrigida)
                                </option>
                                <option
                                    value="3" {{ old('data')['tratamento_arcada_superior'] == 3 ? 'selected' : '' }}>Não
                                    será tratada (má oclusão será mantida)
                                </option>
                            </select>
                            <small class="form-text text-danger">
                                {{ $errors->first('data.tratamento_arcada_superior') }}
                            </small>
                        </div>
                        <div class="col-md-6">
                            <label>Arcada inferior será:</label>
                            <select class="form-control" name="data[tratamento_arcada_inferior]">
                                <option value="">SELECIONE</option>
                                <option
                                    value="1" {{ old('data')['tratamento_arcada_superior'] == 1 ? 'selected' : '' }}>
                                    Tratada com alinhador (má oclusão será corrigida)
                                </option>
                                <option
                                    value="2" {{ old('data')['tratamento_arcada_superior'] == 2 ? 'selected' : '' }}>
                                    Tratada com ortodontia fixa (má oclusão será corrigida)
                                </option>
                                <option
                                    value="3" {{ old('data')['tratamento_arcada_superior'] == 3 ? 'selected' : '' }}>Não
                                    será tratada (má oclusão será mantida)
                                </option>
                            </select>
                            <small class="form-text text-danger">
                                {{ $errors->first('data.tratamento_arcada_inferior') }}
                            </small>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <hr/>
                    </div>
                    <div class="col-md-12"><label>3 - RESTRIÇÃO DE MOVIMENTO DENTÁRIO (Exemplo: implante)</label></div>
                    <div id="restricao_movimento_dentario_radio">
                        <div class="col-md-12">
                            <div class="radio">
                                <label>
                                    <input
                                        type="radio"
                                        name="restricao_movimento_dentario"
                                        value="0"
                                        checked
                                    />Não há restrição (mover todos dentes)
                                </label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="radio">
                                <label>
                                    <input
                                        type="radio"
                                        name="restricao_movimento_dentario"
                                        value="1"
                                        {{ old('restricao_movimento_dentario') == '1' ? 'checked' : '' }}
                                    />Estes dentes específicos não podem ser movimentados:
                                </label>
                            </div>
                        </div>
                    </div>

                    <div id="restricao_movimento_dentario_box"
                         style="display: {{ old('restricao_movimento_dentario') == '1' ? 'block' : 'none' }}">
                        <div class="col-md-6" style="padding: 0px;">
                            <div class="col-md-12" style="padding: 0px;">
                                <div class="col-md-1" style="padding: 0px;">
                                    <center>
                                        <label>
                                            <img src="{{ asset('images/18.jpg') }}" class="img-responsive"/><br/>18<br/>
                                            <input type="checkbox"
                                                   name="data[restricao_movimento_dentario][18]" {{ isset(old('data')['restricao_movimento_dentario'][18]) ? 'checked' : '' }}>
                                        </label>
                                    </center>
                                </div>
                                <div class="col-md-1" style="padding: 0px;">
                                    <center>
                                        <label>
                                            <img src="{{ asset('images/17.jpg') }}" class="img-responsive"/><br/>17<br/>
                                            <input type="checkbox"
                                                   name="data[restricao_movimento_dentario][17]" {{ isset(old('data')['restricao_movimento_dentario'][17]) ? 'checked' : '' }}>
                                        </label>
                                    </center>
                                </div>
                                <div class="col-md-1" style="padding: 0px;">
                                    <center>
                                        <label>
                                            <img src="{{ asset('images/16.jpg') }}" class="img-responsive"/><br/>16<br/>
                                            <input type="checkbox"
                                                   name="data[restricao_movimento_dentario][16]" {{ isset(old('data')['restricao_movimento_dentario'][16]) ? 'checked' : '' }}>
                                        </label>
                                    </center>
                                </div>
                                <div class="col-md-1" style="padding: 0px;">
                                    <center>
                                        <label>
                                            <img src="{{ asset('images/15.jpg') }}" class="img-responsive"/><br/>15<br/>
                                            <input type="checkbox"
                                                   name="data[restricao_movimento_dentario][15]" {{ isset(old('data')['restricao_movimento_dentario'][15]) ? 'checked' : '' }}>
                                        </label>
                                    </center>
                                </div>
                                <div class="col-md-1" style="padding: 0px;">
                                    <center>
                                        <label>
                                            <img src="{{ asset('images/14.jpg') }}" class="img-responsive"/><br/>14<br/>
                                            <input type="checkbox"
                                                   name="data[restricao_movimento_dentario][14]" {{ isset(old('data')['restricao_movimento_dentario'][14]) ? 'checked' : '' }}>
                                        </label>
                                    </center>
                                </div>
                                <div class="col-md-1" style="padding: 0px;">
                                    <center>
                                        <label>
                                            <img src="{{ asset('images/13.jpg') }}" class="img-responsive"/><br/>13<br/>
                                            <input type="checkbox"
                                                   name="data[restricao_movimento_dentario][13]" {{ isset(old('data')['restricao_movimento_dentario'][13]) ? 'checked' : '' }}>
                                        </label>
                                    </center>
                                </div>
                                <div class="col-md-1" style="padding: 0px;">
                                    <center>
                                        <label>
                                            <img src="{{ asset('images/12.jpg') }}" class="img-responsive"/><br/>12<br/>
                                            <input type="checkbox"
                                                   name="data[restricao_movimento_dentario][12]" {{ isset(old('data')['restricao_movimento_dentario'][12]) ? 'checked' : '' }}>
                                        </label>
                                    </center>
                                </div>
                                <div class="col-md-1" style="padding: 0px;">
                                    <center>
                                        <label>
                                            <img src="{{ asset('images/11.jpg') }}" class="img-responsive"/><br/>11<br/>
                                            <input type="checkbox"
                                                   name="data[restricao_movimento_dentario][11]" {{ isset(old('data')['restricao_movimento_dentario'][11]) ? 'checked' : '' }}>
                                        </label>
                                    </center>
                                </div>
                                <div class="col-md-1" style="padding: 0px;">
                                    <center>
                                        <label>
                                            <img src="{{ asset('images/21.jpg') }}" class="img-responsive"/><br/>21<br/>
                                            <input type="checkbox"
                                                   name="data[restricao_movimento_dentario][21]" {{ isset(old('data')['restricao_movimento_dentario'][21]) ? 'checked' : '' }}>
                                        </label>
                                    </center>
                                </div>
                                <div class="col-md-1" style="padding: 0px;">
                                    <center>
                                        <label>
                                            <img src="{{ asset('images/22.jpg') }}" class="img-responsive"/><br/>22<br/>
                                            <input type="checkbox"
                                                   name="data[restricao_movimento_dentario][22]" {{ isset(old('data')['restricao_movimento_dentario'][22]) ? 'checked' : '' }}>
                                        </label>
                                    </center>
                                </div>
                                <div class="col-md-1" style="padding: 0px;">
                                    <center>
                                        <label>
                                            <img src="{{ asset('images/23.jpg') }}" class="img-responsive"/><br/>23<br/>
                                            <input type="checkbox"
                                                   name="data[restricao_movimento_dentario][23]" {{ isset(old('data')['restricao_movimento_dentario'][23]) ? 'checked' : '' }}>
                                        </label>
                                    </center>
                                </div>
                                <div class="col-md-1" style="padding: 0px;">
                                    <center>
                                        <label>
                                            <img src="{{ asset('images/22.jpg') }}" class="img-responsive"/><br/>22<br/>
                                            <input type="checkbox"
                                                   name="data[restricao_movimento_dentario][22]" {{ isset(old('data')['restricao_movimento_dentario'][22]) ? 'checked' : '' }}>
                                        </label>
                                    </center>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6" style="padding: 0px;">
                            <div class="col-md-12" style="padding: 0px;">
                                <div class="col-md-1" style="padding: 0px;">
                                    <center>
                                        <label>
                                            <img src="{{ asset('images/25.jpg') }}" class="img-responsive"/><br/>25<br/>
                                            <input type="checkbox"
                                                   name="data[restricao_movimento_dentario][25]" {{ isset(old('data')['restricao_movimento_dentario'][25]) ? 'checked' : '' }}>
                                        </label>
                                    </center>
                                </div>
                                <div class="col-md-1" style="padding: 0px;">
                                    <center>
                                        <label>
                                            <img src="{{ asset('images/26.jpg') }}" class="img-responsive"/><br/>26<br/>
                                            <input type="checkbox"
                                                   name="data[restricao_movimento_dentario][26]" {{ isset(old('data')['restricao_movimento_dentario'][26]) ? 'checked' : '' }}>
                                        </label>
                                    </center>
                                </div>
                                <div class="col-md-1" style="padding: 0px;">
                                    <center>
                                        <label>
                                            <img src="{{ asset('images/27.jpg') }}" class="img-responsive"/><br/>27<br/>
                                            <input type="checkbox"
                                                   name="data[restricao_movimento_dentario][27]" {{ isset(old('data')['restricao_movimento_dentario'][27]) ? 'checked' : '' }}>
                                        </label>
                                    </center>
                                </div>
                                <div class="col-md-1" style="padding: 0px;">
                                    <center>
                                        <label>
                                            <img src="{{ asset('images/28.jpg') }}" class="img-responsive"/><br/>28<br/>
                                            <input type="checkbox"
                                                   name="data[restricao_movimento_dentario][28]" {{ isset(old('data')['restricao_movimento_dentario'][28]) ? 'checked' : '' }}>
                                        </label>
                                    </center>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">&nbsp;</div>

                        <div class="col-md-6" style="padding: 0px;">
                            <div class="col-md-12" style="padding: 0px;">
                                <div class="col-md-1" style="padding: 0px;">
                                    <center>
                                        <label>
                                            <img src="{{ asset('images/48.jpg') }}" class="img-responsive"/><br/>48<br/>
                                            <input type="checkbox"
                                                   name="data[restricao_movimento_dentario][48]" {{ isset(old('data')['restricao_movimento_dentario'][48]) ? 'checked' : '' }}>
                                        </label>
                                    </center>
                                </div>
                                <div class="col-md-1" style="padding: 0px;">
                                    <center>
                                        <label>
                                            <img src="{{ asset('images/47.jpg') }}" class="img-responsive"/><br/>47<br/>
                                            <input type="checkbox"
                                                   name="data[restricao_movimento_dentario][47]" {{ isset(old('data')['restricao_movimento_dentario'][47]) ? 'checked' : '' }}>
                                        </label>
                                    </center>
                                </div>
                                <div class="col-md-1" style="padding: 0px;">
                                    <center>
                                        <label>
                                            <img src="{{ asset('images/46.jpg') }}" class="img-responsive"/><br/>46<br/>
                                            <input type="checkbox"
                                                   name="data[restricao_movimento_dentario][46]" {{ isset(old('data')['restricao_movimento_dentario'][46]) ? 'checked' : '' }}>
                                        </label>
                                    </center>
                                </div>
                                <div class="col-md-1" style="padding: 0px;">
                                    <center>
                                        <label>
                                            <img src="{{ asset('images/45.jpg') }}" class="img-responsive"/><br/>45<br/>
                                            <input type="checkbox"
                                                   name="data[restricao_movimento_dentario][45]" {{ isset(old('data')['restricao_movimento_dentario'][45]) ? 'checked' : '' }}>
                                        </label>
                                    </center>
                                </div>
                                <div class="col-md-1" style="padding: 0px;">
                                    <center>
                                        <label>
                                            <img src="{{ asset('images/44.jpg') }}" class="img-responsive"/><br/>44<br/>
                                            <input type="checkbox"
                                                   name="data[restricao_movimento_dentario][44]" {{ isset(old('data')['restricao_movimento_dentario'][44]) ? 'checked' : '' }}>
                                        </label>
                                    </center>
                                </div>
                                <div class="col-md-1" style="padding: 0px;">
                                    <center>
                                        <label>
                                            <img src="{{ asset('images/43.jpg') }}" class="img-responsive"/><br/>43<br/>
                                            <input type="checkbox"
                                                   name="data[restricao_movimento_dentario][43]" {{ isset(old('data')['restricao_movimento_dentario'][43]) ? 'checked' : '' }}>
                                        </label>
                                    </center>
                                </div>
                                <div class="col-md-1" style="padding: 0px;">
                                    <center>
                                        <label>
                                            <img src="{{ asset('images/42.jpg') }}" class="img-responsive"/><br/>42<br/>
                                            <input type="checkbox"
                                                   name="data[restricao_movimento_dentario][42]" {{ isset(old('data')['restricao_movimento_dentario'][42]) ? 'checked' : '' }}>
                                        </label>
                                    </center>
                                </div>
                                <div class="col-md-1" style="padding: 0px;">
                                    <center>
                                        <label>
                                            <img src="{{ asset('images/41.jpg') }}" class="img-responsive"/><br/>41<br/>
                                            <input type="checkbox"
                                                   name="data[restricao_movimento_dentario][41]" {{ isset(old('data')['restricao_movimento_dentario'][41]) ? 'checked' : '' }}>
                                        </label>
                                    </center>
                                </div>
                                <div class="col-md-1" style="padding: 0px;">
                                    <center>
                                        <label>
                                            <img src="{{ asset('images/31.jpg') }}" class="img-responsive"/><br/>31<br/>
                                            <input type="checkbox"
                                                   name="data[restricao_movimento_dentario][31]" {{ isset(old('data')['restricao_movimento_dentario'][31]) ? 'checked' : '' }}>
                                        </label>
                                    </center>
                                </div>
                                <div class="col-md-1" style="padding: 0px;">
                                    <center>
                                        <label>
                                            <img src="{{ asset('images/32.jpg') }}" class="img-responsive"/><br/>32<br/>
                                            <input type="checkbox"
                                                   name="data[restricao_movimento_dentario][32]" {{ isset(old('data')['restricao_movimento_dentario'][32]) ? 'checked' : '' }}>
                                        </label>
                                    </center>
                                </div>
                                <div class="col-md-1" style="padding: 0px;">
                                    <center>
                                        <label>
                                            <img src="{{ asset('images/33.jpg') }}" class="img-responsive"/><br/>33<br/>
                                            <input type="checkbox"
                                                   name="data[restricao_movimento_dentario][33]" {{ isset(old('data')['restricao_movimento_dentario'][33]) ? 'checked' : '' }}>
                                        </label>
                                    </center>
                                </div>
                                <div class="col-md-1" style="padding: 0px;">
                                    <center>
                                        <label>
                                            <img src="{{ asset('images/34.jpg') }}" class="img-responsive"/><br/>34<br/>
                                            <input type="checkbox"
                                                   name="data[restricao_movimento_dentario][34]" {{ isset(old('data')['restricao_movimento_dentario'][34]) ? 'checked' : '' }}>
                                        </label>
                                    </center>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6" style="padding: 0px;">
                            <div class="col-md-12" style="padding: 0px;">
                                <div class="col-md-1" style="padding: 0px;">
                                    <center>
                                        <label>
                                            <img src="{{ asset('images/35.jpg') }}" class="img-responsive"/><br/>35<br/>
                                            <input type="checkbox"
                                                   name="data[restricao_movimento_dentario][35]" {{ isset(old('data')['restricao_movimento_dentario'][35]) ? 'checked' : '' }}>
                                        </label>
                                    </center>
                                </div>
                                <div class="col-md-1" style="padding: 0px;">
                                    <center>
                                        <label>
                                            <img src="{{ asset('images/36.jpg') }}" class="img-responsive"/><br/>36<br/>
                                            <input type="checkbox"
                                                   name="data[restricao_movimento_dentario][36]" {{ isset(old('data')['restricao_movimento_dentario'][36]) ? 'checked' : '' }}>
                                        </label>
                                    </center>
                                </div>
                                <div class="col-md-1" style="padding: 0px;">
                                    <center>
                                        <label>
                                            <img src="{{ asset('images/37.jpg') }}" class="img-responsive"/><br/>37<br/>
                                            <input type="checkbox"
                                                   name="data[restricao_movimento_dentario][37]" {{ isset(old('data')['restricao_movimento_dentario'][37]) ? 'checked' : '' }}>
                                        </label>
                                    </center>
                                </div>
                                <div class="col-md-1" style="padding: 0px;">
                                    <center>
                                        <label>
                                            <img src="{{ asset('images/38.jpg') }}" class="img-responsive"/><br/>38<br/>
                                            <input type="checkbox"
                                                   name="data[restricao_movimento_dentario][38]" {{ isset(old('data')['restricao_movimento_dentario'][38]) ? 'checked' : '' }}>
                                        </label>
                                    </center>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <hr/>
                    </div>
                    <div class="col-md-12"><label>4 - ATTACHMENTS</label></div>
                    <div id="attachments_radio">
                        <div class="col-md-12">
                            <div class="radio">
                                <label>
                                    <input type="radio" name="attachments" value="0" checked/>Coloque todos
                                    os attachments necessários
                                </label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="radio">
                                <label>
                                    <input type="radio" name="attachments"
                                           value="1" {{ old('attachments') == 1 ? 'checked' : '' }} />Não coloque
                                    attachments nestes dentes:
                                </label>
                            </div>
                        </div>
                    </div>

                    <div id="attachments_box" style="display: {{ old('attachments') == 1 ? 'block' : 'none' }}">
                        <div class="col-md-6" style="padding: 0px;">
                            <div class="col-md-12" style="padding: 0px;">
                                <div class="col-md-1" style="padding: 0px;">
                                    <center>
                                        <label>
                                            <img src="{{ asset('images/18.jpg') }}" class="img-responsive"/><br/>18<br/>
                                            <input type="checkbox"
                                                   name="data[attachments][18]" {{ isset(old('data')['attachments'][18]) ? 'checked' : '' }}>
                                        </label>
                                    </center>
                                </div>
                                <div class="col-md-1" style="padding: 0px;">
                                    <center>
                                        <label>
                                            <img src="{{ asset('images/17.jpg') }}" class="img-responsive"/><br/>17<br/>
                                            <input type="checkbox"
                                                   name="data[attachments][17]" {{ isset(old('data')['attachments'][17]) ? 'checked' : '' }}>
                                        </label>
                                    </center>
                                </div>
                                <div class="col-md-1" style="padding: 0px;">
                                    <center>
                                        <label>
                                            <img src="{{ asset('images/16.jpg') }}" class="img-responsive"/><br/>16<br/>
                                            <input type="checkbox"
                                                   name="data[attachments][16]" {{ isset(old('data')['attachments'][16]) ? 'checked' : '' }}>
                                        </label>
                                    </center>
                                </div>
                                <div class="col-md-1" style="padding: 0px;">
                                    <center>
                                        <label>
                                            <img src="{{ asset('images/15.jpg') }}" class="img-responsive"/><br/>15<br/>
                                            <input type="checkbox"
                                                   name="data[attachments][15]" {{ isset(old('data')['attachments'][15]) ? 'checked' : '' }}>
                                        </label>
                                    </center>
                                </div>
                                <div class="col-md-1" style="padding: 0px;">
                                    <center>
                                        <label>
                                            <img src="{{ asset('images/14.jpg') }}" class="img-responsive"/><br/>14<br/>
                                            <input type="checkbox"
                                                   name="data[attachments][14]" {{ isset(old('data')['attachments'][14]) ? 'checked' : '' }}>
                                        </label>
                                    </center>
                                </div>
                                <div class="col-md-1" style="padding: 0px;">
                                    <center>
                                        <label>
                                            <img src="{{ asset('images/13.jpg') }}" class="img-responsive"/><br/>13<br/>
                                            <input type="checkbox"
                                                   name="data[attachments][13]" {{ isset(old('data')['attachments'][13]) ? 'checked' : '' }}>
                                        </label>
                                    </center>
                                </div>
                                <div class="col-md-1" style="padding: 0px;">
                                    <center>
                                        <label>
                                            <img src="{{ asset('images/12.jpg') }}" class="img-responsive"/><br/>12<br/>
                                            <input type="checkbox"
                                                   name="data[attachments][12]" {{ isset(old('data')['attachments'][12]) ? 'checked' : '' }}>
                                        </label>
                                    </center>
                                </div>
                                <div class="col-md-1" style="padding: 0px;">
                                    <center>
                                        <label>
                                            <img src="{{ asset('images/11.jpg') }}" class="img-responsive"/><br/>11<br/>
                                            <input type="checkbox"
                                                   name="data[attachments][11]" {{ isset(old('data')['attachments'][11]) ? 'checked' : '' }}>
                                        </label>
                                    </center>
                                </div>
                                <div class="col-md-1" style="padding: 0px;">
                                    <center>
                                        <label>
                                            <img src="{{ asset('images/21.jpg') }}" class="img-responsive"/><br/>21<br/>
                                            <input type="checkbox"
                                                   name="data[attachments][21]" {{ isset(old('data')['attachments'][21]) ? 'checked' : '' }}>
                                        </label>
                                    </center>
                                </div>
                                <div class="col-md-1" style="padding: 0px;">
                                    <center>
                                        <label>
                                            <img src="{{ asset('images/22.jpg') }}" class="img-responsive"/><br/>22<br/>
                                            <input type="checkbox"
                                                   name="data[attachments][22]" {{ isset(old('data')['attachments'][22]) ? 'checked' : '' }}>
                                        </label>
                                    </center>
                                </div>
                                <div class="col-md-1" style="padding: 0px;">
                                    <center>
                                        <label>
                                            <img src="{{ asset('images/23.jpg') }}" class="img-responsive"/><br/>23<br/>
                                            <input type="checkbox"
                                                   name="data[attachments][23]" {{ isset(old('data')['attachments'][23]) ? 'checked' : '' }}>
                                        </label>
                                    </center>
                                </div>
                                <div class="col-md-1" style="padding: 0px;">
                                    <center>
                                        <label>
                                            <img src="{{ asset('images/22.jpg') }}" class="img-responsive"/><br/>22<br/>
                                            <input type="checkbox"
                                                   name="data[attachments][22]" {{ isset(old('data')['attachments'][22]) ? 'checked' : '' }}>
                                        </label>
                                    </center>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6" style="padding: 0px;">
                            <div class="col-md-12" style="padding: 0px;">
                                <div class="col-md-1" style="padding: 0px;">
                                    <center>
                                        <label>
                                            <img src="{{ asset('images/25.jpg') }}" class="img-responsive"/><br/>25<br/>
                                            <input type="checkbox"
                                                   name="data[attachments][25]" {{ isset(old('data')['attachments'][25]) ? 'checked' : '' }}>
                                        </label>
                                    </center>
                                </div>
                                <div class="col-md-1" style="padding: 0px;">
                                    <center>
                                        <label>
                                            <img src="{{ asset('images/26.jpg') }}" class="img-responsive"/><br/>26<br/>
                                            <input type="checkbox"
                                                   name="data[attachments][26]" {{ isset(old('data')['attachments'][26]) ? 'checked' : '' }}>
                                        </label>
                                    </center>
                                </div>
                                <div class="col-md-1" style="padding: 0px;">
                                    <center>
                                        <label>
                                            <img src="{{ asset('images/27.jpg') }}" class="img-responsive"/><br/>27<br/>
                                            <input type="checkbox"
                                                   name="data[attachments][27]" {{ isset(old('data')['attachments'][27]) ? 'checked' : '' }}>
                                        </label>
                                    </center>
                                </div>
                                <div class="col-md-1" style="padding: 0px;">
                                    <center>
                                        <label>
                                            <img src="{{ asset('images/28.jpg') }}" class="img-responsive"/><br/>28<br/>
                                            <input type="checkbox"
                                                   name="data[attachments][28]" {{ isset(old('data')['attachments'][28]) ? 'checked' : '' }}>
                                        </label>
                                    </center>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">&nbsp;</div>

                        <div class="col-md-6" style="padding: 0px;">
                            <div class="col-md-12" style="padding: 0px;">
                                <div class="col-md-1" style="padding: 0px;">
                                    <center>
                                        <label>
                                            <img src="{{ asset('images/48.jpg') }}" class="img-responsive"/><br/>48<br/>
                                            <input type="checkbox"
                                                   name="data[attachments][48]" {{ isset(old('data')['attachments'][48]) ? 'checked' : '' }}>
                                        </label>
                                    </center>
                                </div>
                                <div class="col-md-1" style="padding: 0px;">
                                    <center>
                                        <label>
                                            <img src="{{ asset('images/47.jpg') }}" class="img-responsive"/><br/>47<br/>
                                            <input type="checkbox"
                                                   name="data[attachments][47]" {{ isset(old('data')['attachments'][47]) ? 'checked' : '' }}>
                                        </label>
                                    </center>
                                </div>
                                <div class="col-md-1" style="padding: 0px;">
                                    <center>
                                        <label>
                                            <img src="{{ asset('images/46.jpg') }}" class="img-responsive"/><br/>46<br/>
                                            <input type="checkbox"
                                                   name="data[attachments][46]" {{ isset(old('data')['attachments'][46]) ? 'checked' : '' }}>
                                        </label>
                                    </center>
                                </div>
                                <div class="col-md-1" style="padding: 0px;">
                                    <center>
                                        <label>
                                            <img src="{{ asset('images/45.jpg') }}" class="img-responsive"/><br/>45<br/>
                                            <input type="checkbox"
                                                   name="data[attachments][45]" {{ isset(old('data')['attachments'][45]) ? 'checked' : '' }}>
                                        </label>
                                    </center>
                                </div>
                                <div class="col-md-1" style="padding: 0px;">
                                    <center>
                                        <label>
                                            <img src="{{ asset('images/44.jpg') }}" class="img-responsive"/><br/>44<br/>
                                            <input type="checkbox"
                                                   name="data[attachments][44]" {{ isset(old('data')['attachments'][44]) ? 'checked' : '' }}>
                                        </label>
                                    </center>
                                </div>
                                <div class="col-md-1" style="padding: 0px;">
                                    <center>
                                        <label>
                                            <img src="{{ asset('images/43.jpg') }}" class="img-responsive"/><br/>43<br/>
                                            <input type="checkbox"
                                                   name="data[attachments][43]" {{ isset(old('data')['attachments'][43]) ? 'checked' : '' }}>
                                        </label>
                                    </center>
                                </div>
                                <div class="col-md-1" style="padding: 0px;">
                                    <center>
                                        <label>
                                            <img src="{{ asset('images/42.jpg') }}" class="img-responsive"/><br/>42<br/>
                                            <input type="checkbox"
                                                   name="data[attachments][42]" {{ isset(old('data')['attachments'][42]) ? 'checked' : '' }}>
                                        </label>
                                    </center>
                                </div>
                                <div class="col-md-1" style="padding: 0px;">
                                    <center>
                                        <label>
                                            <img src="{{ asset('images/41.jpg') }}" class="img-responsive"/><br/>41<br/>
                                            <input type="checkbox"
                                                   name="data[attachments][41]" {{ isset(old('data')['attachments'][41]) ? 'checked' : '' }}>
                                        </label>
                                    </center>
                                </div>
                                <div class="col-md-1" style="padding: 0px;">
                                    <center>
                                        <label>
                                            <img src="{{ asset('images/31.jpg') }}" class="img-responsive"/><br/>31<br/>
                                            <input type="checkbox"
                                                   name="data[attachments][31]" {{ isset(old('data')['attachments'][31]) ? 'checked' : '' }}>
                                        </label>
                                    </center>
                                </div>
                                <div class="col-md-1" style="padding: 0px;">
                                    <center>
                                        <label>
                                            <img src="{{ asset('images/32.jpg') }}" class="img-responsive"/><br/>32<br/>
                                            <input type="checkbox"
                                                   name="data[attachments][32]" {{ isset(old('data')['attachments'][32]) ? 'checked' : '' }}>
                                        </label>
                                    </center>
                                </div>
                                <div class="col-md-1" style="padding: 0px;">
                                    <center>
                                        <label>
                                            <img src="{{ asset('images/33.jpg') }}" class="img-responsive"/><br/>33<br/>
                                            <input type="checkbox"
                                                   name="data[attachments][33]" {{ isset(old('data')['attachments'][33]) ? 'checked' : '' }}>
                                        </label>
                                    </center>
                                </div>
                                <div class="col-md-1" style="padding: 0px;">
                                    <center>
                                        <label>
                                            <img src="{{ asset('images/34.jpg') }}" class="img-responsive"/><br/>34<br/>
                                            <input type="checkbox"
                                                   name="data[attachments][34]" {{ isset(old('data')['attachments'][34]) ? 'checked' : '' }}>
                                        </label>
                                    </center>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6" style="padding: 0px;">
                            <div class="col-md-12" style="padding: 0px;">
                                <div class="col-md-1" style="padding: 0px;">
                                    <center>
                                        <label>
                                            <img src="{{ asset('images/35.jpg') }}" class="img-responsive"/><br/>35<br/>
                                            <input type="checkbox"
                                                   name="data[attachments][35]" {{ isset(old('data')['attachments'][35]) ? 'checked' : '' }}>
                                        </label>
                                    </center>
                                </div>
                                <div class="col-md-1" style="padding: 0px;">
                                    <center>
                                        <label>
                                            <img src="{{ asset('images/36.jpg') }}" class="img-responsive"/><br/>36<br/>
                                            <input type="checkbox"
                                                   name="data[attachments][36]" {{ isset(old('data')['attachments'][36]) ? 'checked' : '' }}>
                                        </label>
                                    </center>
                                </div>
                                <div class="col-md-1" style="padding: 0px;">
                                    <center>
                                        <label>
                                            <img src="{{ asset('images/37.jpg') }}" class="img-responsive"/><br/>37<br/>
                                            <input type="checkbox"
                                                   name="data[attachments][37]" {{ isset(old('data')['attachments'][37]) ? 'checked' : '' }}>
                                        </label>
                                    </center>
                                </div>
                                <div class="col-md-1" style="padding: 0px;">
                                    <center>
                                        <label>
                                            <img src="{{ asset('images/38.jpg') }}" class="img-responsive"/><br/>38<br/>
                                            <input type="checkbox"
                                                   name="data[attachments][38]" {{ isset(old('data')['attachments'][38]) ? 'checked' : '' }}>
                                        </label>
                                    </center>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <hr/>
                    </div>
                    <div class="col-md-12">
                        <label>5 - SOBRECORREÇÕES</label>
                    </div>
                    <div class="col-md-12" id="sobrecorrecoes_rotacoes_radio">
                        <label>5.1 - Sobrecorreção das rotações</label>
                        <div class="radio">
                            <label>
                                <input
                                    type="radio"
                                    name="data[sobrecorrecoes][rotacoes][opcao]"
                                    value="1"
                                    checked
                                >Sobrecorrigir todas as rotações
                            </label>
                        </div>
                        <div class="radio">
                            <label>
                                <input
                                    type="radio"
                                    name="data[sobrecorrecoes][rotacoes][opcao]"
                                    value="2"
                                    {{ old('data')['sobrecorrecoes']['rotacoes']['opcao'] == 2 ? 'checked' : '' }}
                                >Sobrecorrigir apenas as rotações dos dentes
                            </label>
                        </div>
                        <input
                            class="form-control"
                            name="data[sobrecorrecoes][rotacoes][dentes]"
                            placeholder="Descreva os dentes"
                            value="{{ old('data')['sobrecorrecoes']['rotacoes']['dentes'] ?? '' }}"
                            {{ old('data')['sobrecorrecoes']['rotacoes']['opcao'] != 2 ? 'disabled' : '' }}
                            id="sobrecorrecoes_rotacoes_dentes"
                        />
                        <div class="radio">
                            <label>
                                <input
                                    type="radio"
                                    name="data[sobrecorrecoes][rotacoes][opcao]"
                                    value="3"
                                    {{ old('data')['sobrecorrecoes']['rotacoes']['opcao'] == 3 ? 'checked' : '' }}
                                >Não sobrecorrigir as rotações
                            </label>
                        </div>
                    </div>
                    <div class="col-md-12">&nbsp;</div>
                    <div class="col-md-12" id="sobrecorrecoes_intrusoes_radio">
                        <label>5.2 - Sobrecorreção das intrusões</label>
                        <div class="radio">
                            <label>
                                <input
                                    type="radio"
                                    name="data[sobrecorrecoes][intrusoes][opcao]"
                                    value="1"
                                    checked
                                />Sobrecorrigir todas as intrusões
                            </label>
                        </div>
                        <div class="radio">
                            <label>
                                <input
                                    type="radio"
                                    name="data[sobrecorrecoes][intrusoes][opcao]"
                                    value="2"
                                    {{ old('data')['sobrecorrecoes']['intrusoes']['opcao'] == 2 ? 'checked' : '' }}
                                />Sobrecorrigir apenas as intrusões dos dentes
                            </label>
                        </div>
                        <input
                            class="form-control"
                            name="data[sobrecorrecoes][intrusoes][dentes]"
                            placeholder="Descreva os dentes"
                            value="{{ old('data')['sobrecorrecoes']['intrusoes']['dentes'] ?? '' }}"
                            {{ old('data')['sobrecorrecoes']['intrusoes']['opcao'] != 2 ? 'disabled' : '' }}
                            id="sobrecorrecoes_intrusoes_dentes"
                        />
                        <div class="radio">
                            <label>
                                <input
                                    type="radio"
                                    name="data[sobrecorrecoes][intrusoes][opcao]"
                                    value="3"
                                    {{ old('data')['sobrecorrecoes']['intrusoes']['opcao'] == 3 ? 'checked' : '' }}
                                />Não sobrecorrigir as intrusões
                            </label>
                        </div>
                    </div>
                    <div class="col-md-12">&nbsp;</div>
                    <div class="col-md-12" id="sobrecorrecoes_extrusoes_radio">
                        <label>5.3 - Sobrecorreção das extrusões</label>
                        <div class="radio">
                            <label>
                                <input
                                    type="radio"
                                    name="data[sobrecorrecoes][extrusoes][opcao]"
                                    value="1"
                                    checked
                                />Sobrecorrigir todas as extrusões
                            </label>
                        </div>
                        <div class="radio">
                            <label>
                                <input
                                    type="radio"
                                    name="data[sobrecorrecoes][extrusoes][opcao]"
                                    value="2"
                                    {{ old('data')['sobrecorrecoes']['extrusoes']['opcao'] == 2 ? 'checked' : '' }}
                                />Sobrecorrigir apenas as extrusões dos dentes
                            </label>
                        </div>
                        <input
                            class="form-control"
                            name="data[sobrecorrecoes][extrusoes][dentes]"
                            placeholder="Descreva os dentes"
                            value="{{ old('data')['sobrecorrecoes']['extrusoes']['dentes'] ?? '' }}"
                            {{ old('data')['sobrecorrecoes']['extrusoes']['opcao'] != 2 ? 'disabled' : '' }}
                            id="sobrecorrecoes_extrusoes_dentes"
                        />
                        <div class="radio">
                            <label>
                                <input
                                    type="radio"
                                    name="data[sobrecorrecoes][extrusoes][opcao]"
                                    value="3"
                                    {{ old('data')['sobrecorrecoes']['extrusoes']['opcao'] == 2 ? 'checked' : '' }}
                                />Não sobrecorrigir as extrusões
                            </label>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <hr/>
                    </div>
                    <div class="col-md-12">
                        <label>6 - NIVELAMENTO DOS INCISIVOS SUPERIORES</label>
                    </div>
                    <div class="col-md-12">
                        <div class="radio">
                            <label>
                                <input
                                    type="radio"
                                    name="data[nivelamento_incisivos_superiores][opcao]"
                                    value="1"
                                    checked
                                />Opção 1
                            </label>
                        </div>
                        <div id="nivelamento_incisivos_superiores_box1">
                            <div class="radio" style="margin-left: 30px;">
                                <label>
                                    <input
                                        type="radio"
                                        name="data[nivelamento_incisivos_superiores][detalhe1]"
                                        value="1"
                                        checked
                                        {{ (old('data')['nivelamento_incisivos_superiores']['opcao'] ?? 1) != 1 ? 'disabled' : '' }}
                                    />Nivelar bordas incisivas dos laterais na mesma altura dos centrais
                                </label>
                            </div>
                            <div class="radio" style="margin-left: 30px;">
                                <label>
                                    <input
                                        type="radio"
                                        name="data[nivelamento_incisivos_superiores][detalhe1]"
                                        value="2"
                                        {{ (old('data')['nivelamento_incisivos_superiores']['detalhe1'] ?? '') == 2 ? 'checked' : ''}}
                                        {{ (old('data')['nivelamento_incisivos_superiores']['opcao'] ?? 1) != 1 ? 'disabled' : '' }}
                                    />Nivelar bordas incisivas dos laterais 0,5 mm mais cervicais às bordas incisivas
                                    dos
                                    centrais
                                </label>
                            </div>
                            <div class="radio" style="margin-left: 30px;">
                                <label>
                                    <input
                                        type="radio"
                                        name="data[nivelamento_incisivos_superiores][detalhe1]"
                                        value="3"
                                        {{ (old('data')['nivelamento_incisivos_superiores']['detalhe1'] ?? '' ) == 3 ? 'checked' : ''}}
                                        {{ (old('data')['nivelamento_incisivos_superiores']['opcao'] ?? 1) != 1 ? 'disabled' : '' }}
                                    />Outra orientação
                                </label>
                            </div>
                            <div class="col-md-8">
                                <input
                                    id="nivelamento_incisivos_superiores_outra_orientacao_1"
                                    style="margin-left: 30px;"
                                    class="form-control"
                                    name="data[nivelamento_incisivos_superiores][outra_orientacao]"
                                    placeholder="Descreva outra orientação."
                                    value="{{ old('data')['nivelamento_incisivos_superiores']['outra_orientacao'] ?? '' }}"
                                    {{ (old('data')['nivelamento_incisivos_superiores']['opcao'] ?? 1) != 1 ? 'disabled' : '' }}
                                    {{ old('data')['nivelamento_incisivos_superiores']['detalhe1'] != 3 ? 'disabled' : '' }}
                                />
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">&nbsp;</div>
                    <div class="col-md-12">
                        <div class="radio">
                            <label>
                                <input
                                    type="radio"
                                    name="data[nivelamento_incisivos_superiores][opcao]"
                                    value="2"
                                    {{ old('data')['nivelamento_incisivos_superiores']['opcao'] == 2 ? 'checked' : '' }}
                                />Opção 2<br/>
                                Nivelar pelas margens gengivais, tendo como referência o seguinte incisivo central:
                            </label>
                        </div>
                        <div id="nivelamento_incisivos_superiores_box2">
                            <div class="radio" style="margin-left: 30px;">
                                <label>
                                    <input
                                        type="radio"
                                        name="data[nivelamento_incisivos_superiores][detalhe2]"
                                        value="1"
                                        checked
                                        {{ (old('data')['nivelamento_incisivos_superiores']['opcao'] ?? 1) != 2 ? 'disabled' : '' }}
                                    />11
                                </label>
                            </div>
                            <div class="radio" style="margin-left: 30px;">
                                <label>
                                    <input
                                        type="radio"
                                        name="data[nivelamento_incisivos_superiores][detalhe2]"
                                        value="2"
                                        {{ (old('data')['nivelamento_incisivos_superiores']['detalhe2'] ?? '') == 2 ? 'checked' : ''}}
                                        {{ (old('data')['nivelamento_incisivos_superiores']['opcao'] ?? 1) != 2 ? 'disabled' : '' }}
                                    />22
                                </label>
                            </div>
                            <div class="radio" style="margin-left: 30px;">
                                <label>
                                    <input
                                        type="radio"
                                        name="data[nivelamento_incisivos_superiores][detalhe2]"
                                        value="3"
                                        {{ (old('data')['nivelamento_incisivos_superiores']['detalhe2'] ?? '') == 3 ? 'checked' : ''}}
                                        {{ (old('data')['nivelamento_incisivos_superiores']['opcao'] ?? 1) != 2 ? 'disabled' : '' }}
                                    />Outra orientação
                                </label>
                            </div>
                            <div class="col-md-8">
                                <input
                                    id="nivelamento_incisivos_superiores_outra_orientacao_2"
                                    style="margin-left: 30px;"
                                    class="form-control"
                                    name="data[nivelamento_incisivos_superiores][outra_orientacao]"
                                    placeholder="Descreva outra orientação."
                                    value="{{ old('data')['nivelamento_incisivos_superiores']['outra_orientacao'] ?? '' }}"
                                    {{ (old('data')['nivelamento_incisivos_superiores']['opcao'] ?? 1) != 2 ? 'disabled' : '' }}
                                    {{ (old('data')['nivelamento_incisivos_superiores']['detalhe2'] ?? 1) != 3 ? 'disabled' : '' }}
                                />
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <hr/>
                    </div>
                    <div class="col-md-12">
                        <label>7 - RELAÇÃO ÂNTERO-POSTERIOR (A-P). ATENTE-SE AO LADO INDICADO PARA CORREÇÃO.<br/>Recomenda-se
                            o uso de recursos adicionais, como elásticos intermaxilares associados ao tratamento com
                            alinhadores para
                            manutenção da ancoragem durante os movimentos ântero-posteriores. O planejamento e execução
                            destes recursos
                            adicionais são de inteira responsabilidade do ortodontista solicitante em seu ambiente
                            clínico.</label>
                    </div>
                    <div class="col-md-12">&nbsp;</div>
                    <div class="col-md-6">
                        <label>7.1 Lado Esquerdo</label><br/>
                        <label>Opção 01</label>
                        <div class="radio" style="margin-left: 30px;">
                            <label>
                                <input
                                    type="radio" name="data[a_p][esquerdo]"
                                    value="1"
                                    checked
                                />Manter relação de caninos esquerdos
                            </label>
                        </div>
                        <label>Opção 02</label>
                        <div class="radio" style="margin-left: 30px;">
                            <label>
                                <input
                                    type="radio" name="data[a_p][esquerdo]"
                                    value="2"
                                    {{ (old('data')['a_p']['direito'] ?? '') == 2 ? 'checked' : '' }}
                                />Melhorar relacionamento A-P de caninos esquerdos,
                                até 1 mm (na ausência de diastemas, DIP porterior será
                                necessário)
                            </label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label>7.2 Lado Direito</label><br/>
                        <label>Opção 01</label>
                        <div class="radio" style="margin-left: 30px;">
                            <label>
                                <input
                                    type="radio"
                                    name="data[a_p][direito]"
                                    value="1"
                                    checked
                                />Manter relação de caninos esquerdos
                            </label>
                        </div>
                        <label>Opção 02</label>
                        <div class="radio" style="margin-left: 30px;">
                            <label>
                                <input
                                    type="radio"
                                    name="data[a_p][direito]"
                                    value="2"
                                    {{ (old('data')['a_p']['direito'] ?? '') == 2 ? 'checked' : '' }}
                                />Melhorar relacionamento A-P de caninos esquerdos,
                                até 1 mm (na ausência de diastemas, DIP porterior será
                                necessário)
                            </label>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <hr/>
                    </div>
                    <div class="col-md-12">
                        <label>
                            8 - SOBRESSALIÊNCIA
                        </label>
                        <div class="radio">
                            <label>
                                <input
                                    type="radio"
                                    name="data[sobresaliencia]"
                                    value="1"
                                    checked
                                />Mostrar resultados de sobressaliência após alinhamento
                            </label>
                        </div>
                        <div class="radio">
                            <label>
                                <input
                                    type="radio"
                                    name="data[sobresaliencia]"
                                    value="2"
                                    {{ (old('data')['sobresaliencia'] ?? '') == 2 ? 'checked' : ''}}
                                />Manter sobressaliência inicial (pode requerer DIP)
                            </label>
                        </div>
                        <div class="radio">
                            <label>
                                <input
                                    type="radio"
                                    name="data[sobresaliencia]"
                                    value="3"
                                    {{ (old('data')['sobresaliencia'] ?? '') == 3 ? 'checked' : ''}}
                                />Reduzir sobressaliência com DIP
                            </label>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <hr/>
                    </div>
                    <div class="col-md-12">
                        <label>
                            9 - SOBREMORDIDA
                        </label>
                        <div class="radio">
                            <label>
                                <input
                                    type="radio"
                                    name="data[sobremordida][opcao]"
                                    value="1"
                                    checked
                                />Mostrar resultados de sobremordida após alinhamento
                            </label>
                        </div>
                        <div class="radio">
                            <label>
                                <input
                                    type="radio"
                                    name="data[sobremordida][opcao]"
                                    value="2"
                                    {{ (old('data')['sobremordida']['opcao'] ?? '') == 2 ? 'checked' : '' }}
                                />Manter sobremordida inicial (pode requerer DIP)
                            </label>
                        </div>
                        <div class="radio">
                            <label>
                                <input
                                    type="radio"
                                    name="data[sobremordida][opcao]"
                                    value="3"
                                    {{ (old('data')['sobremordida']['opcao'] ?? '') == 3 ? 'checked' : '' }}
                                />Alterar sobremordida inicial
                            </label>
                        </div>
                        <div class="col-md-12">&nbsp;</div>
                        <label style="margin-left: 30px;">
                            9.1 - Corrigir mordida aberta (deixe em branco caso não se aplique ao seu caso)<br/>
                            PARA EXTRUSÃO E INTRUSÃO, RECOMENDA-SE O USO DE RECURSOS ADICIONAIS, COMO ELÁSTICOS
                            INTERMAXILARES
                            ASSOCIADOS AO TRATAMENTO COM ALINHADORES. O PLANEJAMENTO E EXECUÇÃO DESTES RECURSOS
                            ADICIONAIS
                            SÃO DE INTEIRA RESPONSABILIDADE DO ORTODONTISTA SOLICITANTE EM SEU AMBIENTE CLÍNICO.<br/>
                            Extruir dentes anteriores
                        </label>
                        <div class="checkbox" style="margin-left: 30px;">
                            <label>
                                <input
                                    type="checkbox"
                                    name="data[sobremordida][detalhes_sobremordida][1]"
                                    value="1"
                                    {{ isset(old('data')['sobremordida']['detalhes_sobremordida'][1]) ? 'checked' : '' }}
                                />Superiores
                            </label>
                        </div>
                        <div class="checkbox" style="margin-left: 30px;">
                            <label>
                                <input
                                    type="checkbox"
                                    name="data[sobremordida][detalhes_sobremordida][2]"
                                    value="1"
                                    {{ isset(old('data')['sobremordida']['detalhes_sobremordida'][2]) ? 'checked' : '' }}
                                />Inferiores
                            </label>
                        </div>
                        <div class="col-md-12">&nbsp;</div>
                        <label style="margin-left: 30px;">
                            9.2 - Corrigir mordida profunda (deixe em branco caso não se aplique ao seu caso)<br/>
                            PARA EXTRUSÃO E INTRUSÃO, RECOMENDA-SE O USO DE RECURSOS ADICIONAIS, COMO ELÁSTICOS
                            INTERMAXILARES
                            ASSOCIADOS AO TRATAMENTO COM ALINHADORES. O PLANEJAMENTO E EXECUÇÃO DESTES RECURSOS
                            ADICIONAIS
                            SÃO DE INTEIRA RESPONSABILIDADE DO ORTODONTISTA SOLICITANTE EM SEU AMBIENTE CLÍNICO.<br/>
                            Extruir dentes anteriores
                        </label>
                        <div class="checkbox" style="margin-left: 30px;">
                            <label>
                                <input
                                    type="checkbox"
                                    name="data[sobremordida][detalhes_sobremordida][3]"
                                    value="1"
                                    {{ isset(old('data')['sobremordida']['detalhes_sobremordida'][3]) ? 'checked' : '' }}
                                />Superiores
                            </label>
                        </div>
                        <div class="checkbox" style="margin-left: 30px;">
                            <label>
                                <input
                                    type="checkbox"
                                    name="data[sobremordida][detalhes_sobremordida][4]"
                                    value="1"
                                    {{ isset(old('data')['sobremordida']['detalhes_sobremordida'][4]) ? 'checked' : '' }}
                                />Inferiores
                            </label>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <hr/>
                    </div>
                    <div class="col-md-12">
                        <label>
                            10 - LINHA MÉDIA
                        </label>
                        <div class="radio">
                            <label>
                                <input
                                    type="radio"
                                    name="data[linha_media][opcoes]"
                                    value="1"
                                    checked
                                />Mostrar resultados da linha média após o alinhamento
                            </label>
                        </div>
                        <div class="radio">
                            <label>
                                <input
                                    type="radio"
                                    name="data[linha_media][opcoes]"
                                    value="2"
                                    {{ (old('data')['linha_media']['opcoes'] ?? 1) == 2 ? 'checked' : '' }}
                                />Manter linha média inicial (pode requerer DIP)
                            </label>
                        </div>
                        <div class="radio">
                            <label>
                                <input
                                    type="radio"
                                    name="data[linha_media][opcoes]"
                                    value="3"
                                    {{ (old('data')['linha_media']['opcoes'] ?? 1) == 3 ? 'checked' : '' }}
                                />Corrigir linha média com DIP:
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-6">
                            <label>Superior:</label>
                            <select class="form-control"
                                    name="data[linha_media][superior]" {{ (old('data')['linha_media']['opcoes'] ?? 1) == 3 ? '' : 'disabled' }}>
                                <option
                                    value="1" {{ (old('data')['linha_media']['superior'] ?? 1) == 1 ? 'selected' : '' }}>
                                    Não alterar
                                </option>
                                <option
                                    value="2" {{ (old('data')['linha_media']['superior'] ?? 1) == 2 ? 'selected' : '' }}>
                                    Para direita do paciente
                                </option>
                                <option
                                    value="3" {{ (old('data')['linha_media']['superior'] ?? 1) == 3 ? 'selected' : '' }}>
                                    Para esquerda do paciente
                                </option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label>Inferior:</label>
                            <select class="form-control"
                                    name="data[linha_media][inferior]" {{ (old('data')['linha_media']['opcoes'] ?? 1) == 3 ? '' : 'disabled' }}>
                                <option
                                    value="1" {{ (old('data')['linha_media']['inferior'] ?? 1) == 1 ? 'selected' : '' }}>
                                    Não alterar
                                </option>
                                <option
                                    value="2" {{ (old('data')['linha_media']['inferior'] ?? 1) == 2 ? 'selected' : '' }}>
                                    Para direita do paciente
                                </option>
                                <option
                                    value="3" {{ (old('data')['linha_media']['inferior'] ?? 1) == 3 ? 'selected' : '' }}>
                                    Para esquerda do paciente
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <hr/>
                    </div>
                    <div class="col-md-12">
                        <label>
                            11 - DIASTEMAS & APINHAMENTO
                        </label>
                    </div>
                    <div class="col-md-4">
                        <label>
                            11.1 - Diastemas
                        </label>
                        <div class="radio">
                            <label>
                                <input
                                    type="radio"
                                    name="data[diastemas][opcoes]"
                                    value="1"
                                    checked
                                />Fechar todos os diastemas
                            </label>
                        </div>
                        <div class="radio">
                            <label>
                                <input
                                    type="radio"
                                    name="data[diastemas][opcoes]"
                                    value="2"
                                    {{ (old('data')['diastemas']['opcoes'] ?? 1) == 2 ? 'checked' : ''  }}
                                />Fechar todos os diastemas exceto:
                            </label>
                        </div>
                        <input
                            class="form-control"
                            name="data[diastemas][exceto]"
                            value="{{ old('data')['diastemas']['exceto'] ?? '' }}"
                            placeholder="Descreva os dentes"
                            {{ (old('data')['diastemas']['opcoes'] ?? 1) != 2 ? 'disabled' : ''  }}
                        />
                    </div>
                    <div class="col-md-4">
                        <label>
                            11.2 - Em caso de discrepância de tamanho dentário:
                        </label>
                        <div class="radio">
                            <label>
                                <input
                                    type="radio"
                                    name="data[diastemas][discrepancia_tamanho]"
                                    value="1"
                                    checked
                                />Deixar espaço na mesial dos laterais
                            </label>
                        </div>
                        <div class="radio">
                            <label>
                                <input
                                    type="radio"
                                    name="data[diastemas][discrepancia_tamanho]"
                                    value="2"
                                    {{ (old('data')['diastemas']['discrepancia_tamanho'] ?? '') == 2 ? 'checked' : '' }}
                                />Deixar espaço na distal dos laterais
                            </label>
                        </div>
                        <div class="radio">
                            <label>
                                <input
                                    type="radio"
                                    name="data[diastemas][discrepancia_tamanho]"
                                    value="3"
                                    {{ (old('data')['diastemas']['discrepancia_tamanho'] ?? '') == 3 ? 'checked' : '' }}
                                />Deixar espaços igualmente ao redor dos laterais
                            </label>
                        </div>
                        <div class="radio">
                            <label>
                                <input
                                    type="radio"
                                    name="data[diastemas][discrepancia_tamanho]"
                                    value="4"
                                    {{ (old('data')['diastemas']['discrepancia_tamanho'] ?? '') == 4 ? 'checked' : '' }}
                                />DIP no arco oposto e retração superior
                            </label>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label>
                            11.3 - Para tratamento de casos de fechamento de espaços, realizar sobrecorreção do
                            fechamento
                            (cadeia elástica virtual)
                        </label>
                        <div class="radio">
                            <label>
                                <input
                                    type="radio"
                                    name="data[diastemas][sobrecorrecao_fechamento]"
                                    value="1"
                                    {{ (old('data')['diastemas']['sobrecorrecao_fechamento'] ?? '1') === '1' ? 'checked' : '' }}
                                />Sim
                            </label>
                        </div>
                        <div class="radio">
                            <label>
                                <input
                                    type="radio"
                                    name="data[diastemas][sobrecorrecao_fechamento]"
                                    value="0"
                                    {{ (old('data')['diastemas']['sobrecorrecao_fechamento'] ?? '1') === '0' ? 'checked' : '' }}
                                />Não
                            </label>
                        </div>
                    </div>
                    <div class="col-md-12">&nbsp;</div>
                    <div class="col-md-12">
                        <label>
                            11.4 - Correção do apinhamento (defina as prioridades)
                        </label>
                    </div>
                    <div class="col-md-12">&nbsp;</div>
                    <div class="col-md-6">
                        <label>
                            11.4.1 - Correção superior
                        </label>
                        <br/>
                        <label>
                            Extração transversal
                        </label>
                        <select class="form-control"
                                name="data[diastemas][correcao_apinhamento][superior][extracao_transversal]">
                            <option value="">SELECIONE</option>
                            <option
                                value="1" {{ (old('data')['diastemas']['correcao_apinhamento']['superior']['extracao_transversal'] ?? '') == 1 ? 'selected' : '' }}>
                                Primeira opção
                            </option>
                            <option
                                value="2" {{ (old('data')['diastemas']['correcao_apinhamento']['superior']['extracao_transversal'] ?? '') == 2 ? 'selected' : '' }}>
                                Quando for necessário após a primeira opção
                            </option>
                            <option
                                value="3" {{ (old('data')['diastemas']['correcao_apinhamento']['superior']['extracao_transversal'] ?? '') == 3 ? 'selected' : '' }}>
                                Mínimo necessário
                            </option>
                            <option
                                value="4" {{ (old('data')['diastemas']['correcao_apinhamento']['superior']['extracao_transversal'] ?? '') == 4 ? 'selected' : '' }}>
                                Não realizar
                            </option>
                        </select>
                        <small class="form-text text-danger">
                            {{ $errors->first('data.diastemas.correcao_apinhamento.superior.extracao_transversal') }}
                        </small>
                        <br/>
                        <label>
                            Vestibularização incisivos
                        </label>
                        <select class="form-control"
                                name="data[diastemas][correcao_apinhamento][superior][vestibularizacao_incisivos]">
                            <option value="">SELECIONE</option>
                            <option
                                value="1" {{ (old('data')['diastemas']['correcao_apinhamento']['superior']['vestibularizacao_incisivos'] ?? '') == 1 ? 'selected' : '' }}>
                                Primeira opção
                            </option>
                            <option
                                value="2" {{ (old('data')['diastemas']['correcao_apinhamento']['superior']['vestibularizacao_incisivos'] ?? '') == 2 ? 'selected' : '' }}>
                                Quando for necessário após a primeira opção
                            </option>
                            <option
                                value="3" {{ (old('data')['diastemas']['correcao_apinhamento']['superior']['vestibularizacao_incisivos'] ?? '') == 3 ? 'selected' : '' }}>
                                Mínimo necessário
                            </option>
                            <option
                                value="4" {{ (old('data')['diastemas']['correcao_apinhamento']['superior']['vestibularizacao_incisivos'] ?? '') == 4 ? 'selected' : '' }}>
                                Não realizar
                            </option>
                        </select>
                        <small class="form-text text-danger">
                            {{ $errors->first('data.diastemas.correcao_apinhamento.superior.vestibularizacao_incisivos') }}
                        </small>
                        <br/>
                        <label>
                            DIP - Anterior
                        </label>
                        <select class="form-control"
                                name="data[diastemas][correcao_apinhamento][superior][dip_anterior]">
                            <option value="">SELECIONE</option>
                            <option
                                value="1" {{ (old('data')['diastemas']['correcao_apinhamento']['superior']['dip_anterior'] ?? '') == 1 ? 'selected' : '' }}>
                                Primeira opção
                            </option>
                            <option
                                value="2" {{ (old('data')['diastemas']['correcao_apinhamento']['superior']['dip_anterior'] ?? '') == 2 ? 'selected' : '' }}>
                                Quando for necessário após a primeira opção
                            </option>
                            <option
                                value="3" {{ (old('data')['diastemas']['correcao_apinhamento']['superior']['dip_anterior'] ?? '') == 3 ? 'selected' : '' }}>
                                Mínimo necessário
                            </option>
                            <option
                                value="4" {{ (old('data')['diastemas']['correcao_apinhamento']['superior']['dip_anterior'] ?? '') == 4 ? 'selected' : '' }}>
                                Não realizar
                            </option>
                        </select>
                        <small class="form-text text-danger">
                            {{ $errors->first('data.diastemas.correcao_apinhamento.superior.dip_anterior') }}
                        </small>
                    </div>
                    <div class="col-md-6">
                        <label>
                            11.4.1 - Correção inferior
                        </label>
                        <br/>
                        <label>
                            Extração transversal
                        </label>
                        <select class="form-control"
                                name="data[diastemas][correcao_apinhamento][inferior][extracao_transversal]">
                            <option value="">SELECIONE</option>
                            <option
                                value="1" {{ (old('data')['diastemas']['correcao_apinhamento']['inferior']['extracao_transversal'] ?? '') == 1 ? 'selected' : '' }}>
                                Primeira opção
                            </option>
                            <option
                                value="2" {{ (old('data')['diastemas']['correcao_apinhamento']['inferior']['extracao_transversal'] ?? '') == 2 ? 'selected' : '' }}>
                                Quando for necessário após a primeira opção
                            </option>
                            <option
                                value="3" {{ (old('data')['diastemas']['correcao_apinhamento']['inferior']['extracao_transversal'] ?? '') == 3 ? 'selected' : '' }}>
                                Mínimo necessário
                            </option>
                            <option
                                value="4" {{ (old('data')['diastemas']['correcao_apinhamento']['inferior']['extracao_transversal'] ?? '') == 4 ? 'selected' : '' }}>
                                Não realizar
                            </option>
                        </select>
                        <small class="form-text text-danger">
                            {{ $errors->first('data.diastemas.correcao_apinhamento.inferior.dip_anterior') }}
                        </small>
                        <br/>
                        <label>
                            Vestibularização incisivos
                        </label>
                        <select class="form-control"
                                name="data[diastemas][correcao_apinhamento][inferior][vestibularizacao_incisivos]">
                            <option value="">SELECIONE</option>
                            <option
                                value="1" {{ (old('data')['diastemas']['correcao_apinhamento']['inferior']['vestibularizacao_incisivos'] ?? '') == 1 ? 'selected' : '' }}>
                                Primeira opção
                            </option>
                            <option
                                value="2" {{ (old('data')['diastemas']['correcao_apinhamento']['inferior']['vestibularizacao_incisivos'] ?? '') == 2 ? 'selected' : '' }}>
                                Quando for necessário após a primeira opção
                            </option>
                            <option
                                value="3" {{ (old('data')['diastemas']['correcao_apinhamento']['inferior']['vestibularizacao_incisivos'] ?? '') == 3 ? 'selected' : '' }}>
                                Mínimo necessário
                            </option>
                            <option
                                value="4" {{ (old('data')['diastemas']['correcao_apinhamento']['inferior']['vestibularizacao_incisivos'] ?? '') == 4 ? 'selected' : '' }}>
                                Não realizar
                            </option>
                        </select>
                        <small class="form-text text-danger">
                            {{ $errors->first('data.diastemas.correcao_apinhamento.inferior.vestibularizacao_incisivos') }}
                        </small>
                        <br/>
                        <label>
                            DIP - Anterior
                        </label>
                        <select class="form-control"
                                name="data[diastemas][correcao_apinhamento][inferior][dip_anterior]">
                            <option value="">SELECIONE</option>
                            <option
                                value="1" {{ (old('data')['diastemas']['correcao_apinhamento']['inferior']['dip_anterior'] ?? '') == 1 ? 'selected' : '' }}>
                                Primeira opção
                            </option>
                            <option
                                value="2" {{ (old('data')['diastemas']['correcao_apinhamento']['inferior']['dip_anterior'] ?? '') == 2 ? 'selected' : '' }}>
                                Quando for necessário após a primeira opção
                            </option>
                            <option
                                value="3" {{ (old('data')['diastemas']['correcao_apinhamento']['inferior']['dip_anterior'] ?? '') == 3 ? 'selected' : '' }}>
                                Mínimo necessário
                            </option>
                            <option
                                value="4" {{ (old('data')['diastemas']['correcao_apinhamento']['inferior']['dip_anterior'] ?? '') == 4 ? 'selected' : '' }}>
                                Não realizar
                            </option>
                        </select>
                        <small class="form-text text-danger">
                            {{ $errors->first('data.diastemas.correcao_apinhamento.inferior.dip_anterior') }}
                        </small>
                    </div>
                    <div class="col-md-12">
                        <hr/>
                    </div>
                    <div class="col-md-12">
                        <label>
                            12 - EXPANSÃO DO ARCO
                        </label>
                        <div class="radio">
                            <label>
                                <input
                                    type="radio"
                                    name="data[expansao_arco]"
                                    value="1"
                                    checked
                                />Aumentar a largura do arco na região de caninos apenas
                            </label>
                        </div>
                        <div class="radio">
                            <label>
                                <input
                                    type="radio"
                                    name="data[expansao_arco]"
                                    value="2"
                                    {{ (old('data')['expansao_arco'] ?? '') == 2 ? 'checked' : '' }}
                                />Aumentar a largura do arco na região de caninos e pré-molares
                            </label>
                        </div>
                        <div class="radio">
                            <label>
                                <input
                                    type="radio"
                                    name="data[expansao_arco]"
                                    value="3"
                                    {{ (old('data')['expansao_arco'] ?? '') == 4 ? 'checked' : '' }}
                                />Aumentar a largura do arco na região de pré-molares apenas
                            </label>
                        </div>
                        <div class="radio">
                            <label>
                                <input
                                    type="radio"
                                    name="data[expansao_arco]"
                                    value="4"
                                    {{ (old('data')['expansao_arco'] ?? '') == 5 ? 'checked' : '' }}
                                />Alinhar o arco com mínima alteração de largura
                            </label>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <hr/>
                    </div>
                    <div class="col-md-12">
                        <label>
                            13 - PREFERÊNCIAS CLÍNICAS PARA O DESGASTE PROXIMAL (DIP)<br/>Recomendações para desgaste
                            interproximal (DIP)
                        </label>
                        <div class="radio">
                            <label>
                                <input
                                    type="radio"
                                    name="data[preferencias_clinicas_desgaste_proximal][opcoes]"
                                    value="1"
                                    checked
                                />Restringir desgaste máximo para 0.3 mm em cada face proximal
                            </label>
                        </div>
                        <div class="radio">
                            <label>
                                <input
                                    type="radio"
                                    name="data[preferencias_clinicas_desgaste_proximal][opcoes]"
                                    value="2"
                                    {{ (old('data')['preferencias_clinicas_desgaste_proximal']['opcoes'] ?? '') == 2 ? 'checked' : '' }}
                                />Restringir desgaste máximo para 0.5 mm em cada face proximal
                            </label>
                        </div>
                        <div class="radio">
                            <label>
                                <input
                                    type="radio"
                                    name="data[preferencias_clinicas_desgaste_proximal][opcoes]"
                                    value="3"
                                    {{ (old('data')['preferencias_clinicas_desgaste_proximal']['opcoes'] ?? '') == 3 ? 'checked' : '' }}
                                />Não restringir
                                desgaste máximo em cada face dentária
                            </label>
                        </div>
                        <div class="radio">
                            <label>
                                <input
                                    type="radio"
                                    name="data[preferencias_clinicas_desgaste_proximal][opcoes]"
                                    value="4"
                                    {{ (old('data')['preferencias_clinicas_desgaste_proximal']['opcoes'] ?? '') == 4 ? 'checked' : '' }}
                                />Desejo um desgaste específico no(s) dente(s)/face(s)
                            </label>
                        </div>
                        <input
                            class="form-control"
                            name="data[preferencias_clinicas_desgaste_proximal][dentes]"
                            value="{{ old('data')['preferencias_clinicas_desgaste_proximal']['dentes'] ?? '' }}"
                            placeholder="Descreva os dentes"
                        />
                    </div>
                    <div class="col-md-12">
                        <hr/>
                    </div>
                    <div class="col-md-12">
                        <label for="data_outras_informacoes">
                            14 - OUTRAS INFORMAÇÕES IMPORTANTES PARA REALIZAÇÃO DO SETUP
                        </label>
                        <textarea
                            class="form-control"
                            rows="3"
                            name="data[outras_informacoes]"
                            id="data_outras_informacoes"
                        >{{ old('data')['outras_informacoes'] ?? '' }}</textarea>
                    </div>
                    <div class="col-md-12">
                        <hr/>
                    </div>
                    <div class="col-md-12">
                        <label>
                            15 - ENVIO DE MODELO FÍSICO<br/>O envio de modelos em gesso só é aceito para confecção de
                            contenções (Smart Retainer), para confecção de alinhadores (Smart Aligner) são apenas
                            aceitas
                            moldagens em silicone de adição e modelos virtuais.
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
                            Paciente Escaneado pelo Scan Service?
                        </label>
                        <div class="radio">
                            <label>
                                <input
                                    type="radio"
                                    name="data[scan_service]"
                                    value="1"
                                    {{ (old('data')['scan_service'] ?? 1) == 1 ? 'checked' : '' }}
                                />Sim
                            </label>
                        </div>
                        <div class="radio">
                            <label>
                                <input
                                    type="radio"
                                    name="data[scan_service]"
                                    value="0"
                                    {{ (old('data')['scan_service'] ?? 1) == 0 ? 'checked' : '' }}
                                />Não
                            </label>
                        </div>
                        <br/>
                    </div>
                </div>
                <div class="col-md-12">
                    <hr/>
                </div>
                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary">Ir para envio de Arquivos</button>
                    <button type="reset" class="btn btn-default">Resetar formulário</button>
                </div>

            </div><!-- /.panel-->
        </form>
    </div>
@endsection

@section('scripts')
    <script language="javascript">

        //hide the entire form before dentist and patient are selected
        const hideForm = function () {
            if ($('#patient').val() != '' && $('#dentist').val() != '') {
                $('#collapsible-form').show();
            } else {
                $('#collapsible-form').hide();
            }
        };
        hideForm();
        $('#patient').on('change', hideForm);
        $('#dentist').on('change', hideForm);


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
                $('input[type=file][name="file_scan_service_mandibula"]').prop('disabled', true);
                $('input[type=file][name="file_scan_service_maxila"]').prop('disabled', true);
                $('input[type=file][name="file_scan_service_registro_mordida"]').prop('disabled', true);
            } else {
                $('input[type=file][name="file_scan_service_mandibula"]').prop('disabled', false);
                $('input[type=file][name="file_scan_service_maxila"]').prop('disabled', false);
                $('input[type=file][name="file_scan_service_registro_mordida"]').prop('disabled', false);
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
