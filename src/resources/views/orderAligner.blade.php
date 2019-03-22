@extends('layouts.main')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">Preencha os dados para solicitar.</div>
        <div class="panel-body">
            <div class="col-md-6">
                <div class="form-group">
                    <label>PACIENTES</label>
                    <select class="form-control">
                        <option>SELECIONE</option>
                        <option>Paciente 1</option>
                        <option>Paciente 2</option>
                        <option>Paciente 3</option>
                        <option>Paciente 4</option>
                    </select>
                    <a href="#">Adicionar paciente</a>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>DENTISTA</label>
                    <select class="form-control">
                        <option>SELECIONE</option>
                        <option>Dentista 1</option>
                        <option>Dentista 2</option>
                        <option>Dentista 3</option>
                        <option>Dentista 4</option>
                    </select>
                    <a href="#">Adicionar dentista</a>
                </div>
            </div>

            <div class="col-md-12">
                <div class="radio">
                    <label>
                        <input type="radio" name="optionsRadios" id="optionsRadios2" value="option2">Este caso se trata de um tratamento pré-protético.
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
                            <input type="checkbox" value="">Apinhamento
                        </label>
                    </div>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" value="">Diastemas
                        </label>
                    </div>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" value="">Incisivos vestibularizados
                        </label>
                    </div>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" value="">Incisivos retroinclinados
                        </label>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" value="">Mordida cruzada anterior
                        </label>
                    </div>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" value="">Mordida cruzada posterior
                        </label>
                    </div>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" value="">Classe II 1ª divisão
                        </label>
                    </div>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" value="">Classe II 2ª divisão
                        </label>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" value="">Classe II
                        </label>
                    </div>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" value="">Sobressalência exagerada
                        </label>
                    </div>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" value="">Sobre mordida exagerada
                        </label>
                    </div>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" value="">Mordida aberta anterior
                        </label>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" value="">Arco atrésico
                        </label>
                    </div>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" value="">Desvio de linha média
                        </label>
                    </div>
                </div>
            </div>

            <div class="col-md-12">Observações clínicas atuais do paciente<br/>
                (limitação periodontal, reabsorções radiculares, perfil aceita retrusão ou protrusão de incisivos, etc.)<br/><br/></div>
            <div class="col-md-6">
                <textarea class="form-control" rows="3" placeholder="Preencher com toda informação que possa ser importante para seu caso."></textarea>
            </div>
            <div class="col-md-6">
                <textarea class="form-control" rows="3" placeholder="Objetivo principal e planejamento geral do caso clínico (por favor, forneça o máximo de informação sobre o que se deseja com o tratamento)."></textarea>
            </div>
            <div class="col-md-12"><hr/></div>

            <div class="col-md-12"><label>2 - SELECIONAR A FORMA DE TRATAMENTO DOS ARCOS</label></div>

            <div class="form-group">
                <div class="col-md-6">
                    <label>Arcada superior será:</label>
                    <select class="form-control">
                        <option>SELECIONE</option>
                        <option>Tratada com alinhador (má oclusão será corrigida)</option>
                        <option>Tratada com ortodontia fixa (má oclusão será corrigida)</option>
                        <option>Não será tratada (má oclusão será mantida)</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label>Arcada inferior será:</label>
                    <select class="form-control">
                        <option>SELECIONE</option>
                        <option>Tratada com alinhador (má oclusão será corrigida)</option>
                        <option>Tratada com ortodontia fixa (má oclusão será corrigida)</option>
                        <option>Não será tratada (má oclusão será mantida)</option>
                    </select>
                </div>
            </div>
            <div class="col-md-12"><hr/></div>
            <div class="col-md-12"><label>3 - RESTRIÇÃO DE MOVIMENTO DENTÁRIO (Exemplo: implante)</label></div>
            <div class="col-md-12">
                <div class="radio">
                    <label>
                        <input type="radio" name="optionsRadios2" id="optionsRadios2" value="option2">Não há restrição (mover todos dentes)
                    </label>
                </div>
            </div>
            <div class="col-md-12">
                <div class="radio">
                    <label>
                        <input type="radio" name="optionsRadios2" id="optionsRadios2" value="option2">Estes dentes específicos não podem ser movimentados:
                    </label>
                </div>
            </div>

            <div class="col-md-6" style="padding: 0px;">
                <div class="col-md-12" style="padding: 0px;">
                    <div class="col-md-1" style="padding: 0px;">
                        <center>
                            <label>
                                <img src="{{ asset('images/18.jpg') }}" class="img-responsive"/><br/>18<br/>
                                <input type="checkbox" value="">
                            </label>
                        </center>
                    </div>
                    <div class="col-md-1" style="padding: 0px;">
                        <center>
                            <label>
                                <img src="{{ asset('images/17.jpg') }}" class="img-responsive"/><br/>17<br/>
                                <input type="checkbox" value="">
                            </label>
                        </center>
                    </div>
                    <div class="col-md-1" style="padding: 0px;">
                        <center>
                            <label>
                                <img src="{{ asset('images/16.jpg') }}" class="img-responsive"/><br/>16<br/>
                                <input type="checkbox" value="">
                            </label>
                        </center>
                    </div>
                    <div class="col-md-1" style="padding: 0px;">
                        <center>
                            <label>
                                <img src="{{ asset('images/15.jpg') }}" class="img-responsive"/><br/>15<br/>
                                <input type="checkbox" value="">
                            </label>
                        </center>
                    </div>
                    <div class="col-md-1" style="padding: 0px;">
                        <center>
                            <label>
                                <img src="{{ asset('images/14.jpg') }}" class="img-responsive"/><br/>14<br/>
                                <input type="checkbox" value="">
                            </label>
                        </center>
                    </div>
                    <div class="col-md-1" style="padding: 0px;">
                        <center>
                            <label>
                                <img src="{{ asset('images/13.jpg') }}" class="img-responsive"/><br/>13<br/>
                                <input type="checkbox" value="">
                            </label>
                        </center>
                    </div>
                    <div class="col-md-1" style="padding: 0px;">
                        <center>
                            <label>
                                <img src="{{ asset('images/12.jpg') }}" class="img-responsive"/><br/>12<br/>
                                <input type="checkbox" value="">
                            </label>
                        </center>
                    </div>
                    <div class="col-md-1" style="padding: 0px;">
                        <center>
                            <label>
                                <img src="{{ asset('images/11.jpg') }}" class="img-responsive"/><br/>11<br/>
                                <input type="checkbox" value="">
                            </label>
                        </center>
                    </div>
                    <div class="col-md-1" style="padding: 0px;">
                        <center>
                            <label>
                                <img src="{{ asset('images/21.jpg') }}" class="img-responsive"/><br/>21<br/>
                                <input type="checkbox" value="">
                            </label>
                        </center>
                    </div>
                    <div class="col-md-1" style="padding: 0px;">
                        <center>
                            <label>
                                <img src="{{ asset('images/22.jpg') }}" class="img-responsive"/><br/>22<br/>
                                <input type="checkbox" value="">
                            </label>
                        </center>
                    </div>
                    <div class="col-md-1" style="padding: 0px;">
                        <center>
                            <label>
                                <img src="{{ asset('images/23.jpg') }}" class="img-responsive"/><br/>23<br/>
                                <input type="checkbox" value="">
                            </label>
                        </center>
                    </div>
                    <div class="col-md-1" style="padding: 0px;">
                        <center>
                            <label>
                                <img src="{{ asset('images/22.jpg') }}" class="img-responsive"/><br/>22<br/>
                                <input type="checkbox" value="">
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
                                <input type="checkbox" value="">
                            </label>
                        </center>
                    </div>
                    <div class="col-md-1" style="padding: 0px;">
                        <center>
                            <label>
                                <img src="{{ asset('images/26.jpg') }}" class="img-responsive"/><br/>26<br/>
                                <input type="checkbox" value="">
                            </label>
                        </center>
                    </div>
                    <div class="col-md-1" style="padding: 0px;">
                        <center>
                            <label>
                                <img src="{{ asset('images/27.jpg') }}" class="img-responsive"/><br/>27<br/>
                                <input type="checkbox" value="">
                            </label>
                        </center>
                    </div>
                    <div class="col-md-1" style="padding: 0px;">
                        <center>
                            <label>
                                <img src="{{ asset('images/28.jpg') }}" class="img-responsive"/><br/>28<br/>
                                <input type="checkbox" value="">
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
                                <input type="checkbox" value="">
                            </label>
                        </center>
                    </div>
                    <div class="col-md-1" style="padding: 0px;">
                        <center>
                            <label>
                                <img src="{{ asset('images/47.jpg') }}" class="img-responsive"/><br/>47<br/>
                                <input type="checkbox" value="">
                            </label>
                        </center>
                    </div>
                    <div class="col-md-1" style="padding: 0px;">
                        <center>
                            <label>
                                <img src="{{ asset('images/46.jpg') }}" class="img-responsive"/><br/>46<br/>
                                <input type="checkbox" value="">
                            </label>
                        </center>
                    </div>
                    <div class="col-md-1" style="padding: 0px;">
                        <center>
                            <label>
                                <img src="{{ asset('images/45.jpg') }}" class="img-responsive"/><br/>45<br/>
                                <input type="checkbox" value="">
                            </label>
                        </center>
                    </div>
                    <div class="col-md-1" style="padding: 0px;">
                        <center>
                            <label>
                                <img src="{{ asset('images/44.jpg') }}" class="img-responsive"/><br/>44<br/>
                                <input type="checkbox" value="">
                            </label>
                        </center>
                    </div>
                    <div class="col-md-1" style="padding: 0px;">
                        <center>
                            <label>
                                <img src="{{ asset('images/43.jpg') }}" class="img-responsive"/><br/>43<br/>
                                <input type="checkbox" value="">
                            </label>
                        </center>
                    </div>
                    <div class="col-md-1" style="padding: 0px;">
                        <center>
                            <label>
                                <img src="{{ asset('images/42.jpg') }}" class="img-responsive"/><br/>42<br/>
                                <input type="checkbox" value="">
                            </label>
                        </center>
                    </div>
                    <div class="col-md-1" style="padding: 0px;">
                        <center>
                            <label>
                                <img src="{{ asset('images/41.jpg') }}" class="img-responsive"/><br/>41<br/>
                                <input type="checkbox" value="">
                            </label>
                        </center>
                    </div>
                    <div class="col-md-1" style="padding: 0px;">
                        <center>
                            <label>
                                <img src="{{ asset('images/31.jpg') }}" class="img-responsive"/><br/>31<br/>
                                <input type="checkbox" value="">
                            </label>
                        </center>
                    </div>
                    <div class="col-md-1" style="padding: 0px;">
                        <center>
                            <label>
                                <img src="{{ asset('images/32.jpg') }}" class="img-responsive"/><br/>32<br/>
                                <input type="checkbox" value="">
                            </label>
                        </center>
                    </div>
                    <div class="col-md-1" style="padding: 0px;">
                        <center>
                            <label>
                                <img src="{{ asset('images/33.jpg') }}" class="img-responsive"/><br/>33<br/>
                                <input type="checkbox" value="">
                            </label>
                        </center>
                    </div>
                    <div class="col-md-1" style="padding: 0px;">
                        <center>
                            <label>
                                <img src="{{ asset('images/34.jpg') }}" class="img-responsive"/><br/>34<br/>
                                <input type="checkbox" value="">
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
                                <input type="checkbox" value="">
                            </label>
                        </center>
                    </div>
                    <div class="col-md-1" style="padding: 0px;">
                        <center>
                            <label>
                                <img src="{{ asset('images/36.jpg') }}" class="img-responsive"/><br/>36<br/>
                                <input type="checkbox" value="">
                            </label>
                        </center>
                    </div>
                    <div class="col-md-1" style="padding: 0px;">
                        <center>
                            <label>
                                <img src="{{ asset('images/37.jpg') }}" class="img-responsive"/><br/>37<br/>
                                <input type="checkbox" value="">
                            </label>
                        </center>
                    </div>
                    <div class="col-md-1" style="padding: 0px;">
                        <center>
                            <label>
                                <img src="{{ asset('images/38.jpg') }}" class="img-responsive"/><br/>38<br/>
                                <input type="checkbox" value="">
                            </label>
                        </center>
                    </div>
                </div>
            </div>

            <div class="col-md-12"><hr/></div>
            <div class="col-md-12"><label>4 - ATTACHMENTS</label></div>
            <div class="col-md-12">
                <div class="radio">
                    <label>
                        <input type="radio" name="optionsRadios3" id="optionsRadios2" value="option2">Coloque todos os attachments necessários
                    </label>
                </div>
            </div>
            <div class="col-md-12">
                <div class="radio">
                    <label>
                        <input type="radio" name="optionsRadios3" id="optionsRadios2" value="option2">Não coloque attachments nestes dentes:
                    </label>
                </div>
            </div>

            <div class="col-md-6" style="padding: 0px;">
                <div class="col-md-12" style="padding: 0px;">
                    <div class="col-md-1" style="padding: 0px;">
                        <center>
                            <label>
                                <img src="{{ asset('images/18.jpg') }}" class="img-responsive"/><br/>18<br/>
                                <input type="checkbox" value="">
                            </label>
                        </center>
                    </div>
                    <div class="col-md-1" style="padding: 0px;">
                        <center>
                            <label>
                                <img src="{{ asset('images/17.jpg') }}" class="img-responsive"/><br/>17<br/>
                                <input type="checkbox" value="">
                            </label>
                        </center>
                    </div>
                    <div class="col-md-1" style="padding: 0px;">
                        <center>
                            <label>
                                <img src="{{ asset('images/16.jpg') }}" class="img-responsive"/><br/>16<br/>
                                <input type="checkbox" value="">
                            </label>
                        </center>
                    </div>
                    <div class="col-md-1" style="padding: 0px;">
                        <center>
                            <label>
                                <img src="{{ asset('images/15.jpg') }}" class="img-responsive"/><br/>15<br/>
                                <input type="checkbox" value="">
                            </label>
                        </center>
                    </div>
                    <div class="col-md-1" style="padding: 0px;">
                        <center>
                            <label>
                                <img src="{{ asset('images/14.jpg') }}" class="img-responsive"/><br/>14<br/>
                                <input type="checkbox" value="">
                            </label>
                        </center>
                    </div>
                    <div class="col-md-1" style="padding: 0px;">
                        <center>
                            <label>
                                <img src="{{ asset('images/13.jpg') }}" class="img-responsive"/><br/>13<br/>
                                <input type="checkbox" value="">
                            </label>
                        </center>
                    </div>
                    <div class="col-md-1" style="padding: 0px;">
                        <center>
                            <label>
                                <img src="{{ asset('images/12.jpg') }}" class="img-responsive"/><br/>12<br/>
                                <input type="checkbox" value="">
                            </label>
                        </center>
                    </div>
                    <div class="col-md-1" style="padding: 0px;">
                        <center>
                            <label>
                                <img src="{{ asset('images/11.jpg') }}" class="img-responsive"/><br/>11<br/>
                                <input type="checkbox" value="">
                            </label>
                        </center>
                    </div>
                    <div class="col-md-1" style="padding: 0px;">
                        <center>
                            <label>
                                <img src="{{ asset('images/21.jpg') }}" class="img-responsive"/><br/>21<br/>
                                <input type="checkbox" value="">
                            </label>
                        </center>
                    </div>
                    <div class="col-md-1" style="padding: 0px;">
                        <center>
                            <label>
                                <img src="{{ asset('images/22.jpg') }}" class="img-responsive"/><br/>22<br/>
                                <input type="checkbox" value="">
                            </label>
                        </center>
                    </div>
                    <div class="col-md-1" style="padding: 0px;">
                        <center>
                            <label>
                                <img src="{{ asset('images/23.jpg') }}" class="img-responsive"/><br/>23<br/>
                                <input type="checkbox" value="">
                            </label>
                        </center>
                    </div>
                    <div class="col-md-1" style="padding: 0px;">
                        <center>
                            <label>
                                <img src="{{ asset('images/22.jpg') }}" class="img-responsive"/><br/>22<br/>
                                <input type="checkbox" value="">
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
                                <input type="checkbox" value="">
                            </label>
                        </center>
                    </div>
                    <div class="col-md-1" style="padding: 0px;">
                        <center>
                            <label>
                                <img src="{{ asset('images/26.jpg') }}" class="img-responsive"/><br/>26<br/>
                                <input type="checkbox" value="">
                            </label>
                        </center>
                    </div>
                    <div class="col-md-1" style="padding: 0px;">
                        <center>
                            <label>
                                <img src="{{ asset('images/27.jpg') }}" class="img-responsive"/><br/>27<br/>
                                <input type="checkbox" value="">
                            </label>
                        </center>
                    </div>
                    <div class="col-md-1" style="padding: 0px;">
                        <center>
                            <label>
                                <img src="{{ asset('images/28.jpg') }}" class="img-responsive"/><br/>28<br/>
                                <input type="checkbox" value="">
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
                                <input type="checkbox" value="">
                            </label>
                        </center>
                    </div>
                    <div class="col-md-1" style="padding: 0px;">
                        <center>
                            <label>
                                <img src="{{ asset('images/47.jpg') }}" class="img-responsive"/><br/>47<br/>
                                <input type="checkbox" value="">
                            </label>
                        </center>
                    </div>
                    <div class="col-md-1" style="padding: 0px;">
                        <center>
                            <label>
                                <img src="{{ asset('images/46.jpg') }}" class="img-responsive"/><br/>46<br/>
                                <input type="checkbox" value="">
                            </label>
                        </center>
                    </div>
                    <div class="col-md-1" style="padding: 0px;">
                        <center>
                            <label>
                                <img src="{{ asset('images/45.jpg') }}" class="img-responsive"/><br/>45<br/>
                                <input type="checkbox" value="">
                            </label>
                        </center>
                    </div>
                    <div class="col-md-1" style="padding: 0px;">
                        <center>
                            <label>
                                <img src="{{ asset('images/44.jpg') }}" class="img-responsive"/><br/>44<br/>
                                <input type="checkbox" value="">
                            </label>
                        </center>
                    </div>
                    <div class="col-md-1" style="padding: 0px;">
                        <center>
                            <label>
                                <img src="{{ asset('images/43.jpg') }}" class="img-responsive"/><br/>43<br/>
                                <input type="checkbox" value="">
                            </label>
                        </center>
                    </div>
                    <div class="col-md-1" style="padding: 0px;">
                        <center>
                            <label>
                                <img src="{{ asset('images/42.jpg') }}" class="img-responsive"/><br/>42<br/>
                                <input type="checkbox" value="">
                            </label>
                        </center>
                    </div>
                    <div class="col-md-1" style="padding: 0px;">
                        <center>
                            <label>
                                <img src="{{ asset('images/41.jpg') }}" class="img-responsive"/><br/>41<br/>
                                <input type="checkbox" value="">
                            </label>
                        </center>
                    </div>
                    <div class="col-md-1" style="padding: 0px;">
                        <center>
                            <label>
                                <img src="{{ asset('images/31.jpg') }}" class="img-responsive"/><br/>31<br/>
                                <input type="checkbox" value="">
                            </label>
                        </center>
                    </div>
                    <div class="col-md-1" style="padding: 0px;">
                        <center>
                            <label>
                                <img src="{{ asset('images/32.jpg') }}" class="img-responsive"/><br/>32<br/>
                                <input type="checkbox" value="">
                            </label>
                        </center>
                    </div>
                    <div class="col-md-1" style="padding: 0px;">
                        <center>
                            <label>
                                <img src="{{ asset('images/33.jpg') }}" class="img-responsive"/><br/>33<br/>
                                <input type="checkbox" value="">
                            </label>
                        </center>
                    </div>
                    <div class="col-md-1" style="padding: 0px;">
                        <center>
                            <label>
                                <img src="{{ asset('images/34.jpg') }}" class="img-responsive"/><br/>34<br/>
                                <input type="checkbox" value="">
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
                                <input type="checkbox" value="">
                            </label>
                        </center>
                    </div>
                    <div class="col-md-1" style="padding: 0px;">
                        <center>
                            <label>
                                <img src="{{ asset('images/36.jpg') }}" class="img-responsive"/><br/>36<br/>
                                <input type="checkbox" value="">
                            </label>
                        </center>
                    </div>
                    <div class="col-md-1" style="padding: 0px;">
                        <center>
                            <label>
                                <img src="{{ asset('images/37.jpg') }}" class="img-responsive"/><br/>37<br/>
                                <input type="checkbox" value="">
                            </label>
                        </center>
                    </div>
                    <div class="col-md-1" style="padding: 0px;">
                        <center>
                            <label>
                                <img src="{{ asset('images/38.jpg') }}" class="img-responsive"/><br/>38<br/>
                                <input type="checkbox" value="">
                            </label>
                        </center>
                    </div>
                </div>
            </div>
            <div class="col-md-12"><hr/></div>
            <div class="col-md-12">
                <label>5 - SOBRECORREÇÕES</label>
            </div>
            <div class="col-md-12">
                <label>5.1 - Sobrecorreção das rotações</label>
                <div class="radio">
                    <label>
                        <input type="radio" name="optionsRadios4" id="optionsRadios1" value="option1" >Sobrecorrigir todas as rotações
                    </label>
                </div>
                <div class="radio">
                    <label>
                        <input type="radio" name="optionsRadios4" id="optionsRadios1" value="option1" >Sobrecorrigir apenas as rotações dos dentes
                    </label>
                </div>
                <input class="form-control" name="sobre-rot" placeholder="Descreva os dentes">
                <div class="radio">
                    <label>
                        <input type="radio" name="optionsRadios4" id="optionsRadios1" value="option1" >Não sobrecorrigir as rotações
                    </label>
                </div>
            </div>
            <div class="col-md-12">&nbsp;</div>
            <div class="col-md-12">
                <label>5.2 - Sobrecorreção das intrusões</label>
                <div class="radio">
                    <label>
                        <input type="radio" name="optionsRadios4" id="optionsRadios1" value="option1">Sobrecorrigir todas as intrusões
                    </label>
                </div>
                <div class="radio">
                    <label>
                        <input type="radio" name="optionsRadios4" id="optionsRadios1" value="option1" >Sobrecorrigir apenas as intrusões dos dentes
                    </label>
                </div>
                <input class="form-control" name="sobre-rot" placeholder="Descreva os dentes">
                <div class="radio">
                    <label>
                        <input type="radio" name="optionsRadios4" id="optionsRadios1" value="option1" >Não sobrecorrigir as intrusões
                    </label>
                </div>
            </div>
            <div class="col-md-12">&nbsp;</div>
            <div class="col-md-12">
                <label>5.3 - Sobrecorreção das extrusões</label>
                <div class="radio">
                    <label>
                        <input type="radio" name="optionsRadios4" id="optionsRadios1" value="option1">Sobrecorrigir todas as extrusões
                    </label>
                </div>
                <div class="radio">
                    <label>
                        <input type="radio" name="optionsRadios4" id="optionsRadios1" value="option1" >Sobrecorrigir apenas as extrusões dos dentes
                    </label>
                </div>
                <input class="form-control" name="sobre-rot" placeholder="Descreva os dentes">
                <div class="radio">
                    <label>
                        <input type="radio" name="optionsRadios4" id="optionsRadios1" value="option1" >Não sobrecorrigir as extrusões
                    </label>
                </div>
            </div>

            <div class="col-md-12"><hr/></div>
            <div class="col-md-12">
                <label>6 - NIVELAMENTO DOS INCISIVOS SUPERIORES</label>
            </div>
            <div class="col-md-12">
                <div class="radio">
                    <label>
                        <input type="radio" name="optionsRadios5" id="optionsRadios1" value="option1">Opção 1
                    </label>
                </div>
                <div class="radio" style="margin-left: 30px;">
                    <label>
                        <input type="radio" name="optionsRadios6" id="optionsRadios1" value="option1">Nivelar bordas incisivas dos laterais na mesma altura dos centrais
                    </label>
                </div>
                <div class="radio" style="margin-left: 30px;">
                    <label>
                        <input type="radio" name="optionsRadios6" id="optionsRadios1" value="option1">Nivelar bordas incisivas dos laterais 0,5 mm mais cervicais às bordas incisivas dos centrais
                    </label>
                </div>
                <div class="radio" style="margin-left: 30px;">
                    <label>
                        <input type="radio" name="optionsRadios6" id="optionsRadios1" value="orientacao">Outra orientação
                    </label>
                </div>
                <div class="col-md-8">
                    <input style="margin-left: 30px;" class="form-control" name="sobre-rot" placeholder="Descreva outra orientação.">
                </div>
            </div>
            <div class="col-md-12">&nbsp;</div>
            <div class="col-md-12">
                <div class="radio">
                    <label>
                        <input type="radio" name="optionsRadios5" id="optionsRadios1" value="option1">Opção 2<br/>Nivelar pelas margens gengivais, tendo como referência o seguinte incisivo central:
                    </label>
                </div>
                <div class="radio" style="margin-left: 30px;">
                    <label>
                        <input type="radio" name="optionsRadios8" id="optionsRadios1" value="11">11
                    </label>
                </div>
                <div class="radio" style="margin-left: 30px;">
                    <label>
                        <input type="radio" name="optionsRadios8" id="optionsRadios1" value="22">22
                    </label>
                </div>
                <div class="radio" style="margin-left: 30px;">
                    <label>
                        <input type="radio" name="optionsRadios8" id="optionsRadios1" value="orientacao">Outra orientação
                    </label>
                </div>
                <div class="col-md-8">
                    <input style="margin-left: 30px;" class="form-control" name="sobre-rot" placeholder="Descreva outra orientação.">
                </div>
            </div>
            <div class="col-md-12"><hr/></div>
            <div class="col-md-12">
                <label>7 - RELAÇÃO ÂNTERO-POSTERIOR (A-P). ATENTE-SE AO LADO INDICADO PARA CORREÇÃO.<br/>Recomenda-se o uso de recursos adicionais, como elásticos intermaxilares associados ao tratamento com alinhadores para
                    manutenção da ancoragem durante os movimentos ântero-posteriores. O planejamento e execução destes recursos
                    adicionais são de inteira responsabilidade do ortodontista solicitante em seu ambiente clínico.</label>
            </div>
            <div class="col-md-12">&nbsp;</div>
            <div class="col-md-6">
                <label>7.1 Lado Esquerdo</label><br/>
                <label>Opção 01</label>
                <div class="radio" style="margin-left: 30px;">
                    <label>
                        <input type="radio" name="optionsRadios9" id="optionsRadios1" value="11">Manter relação de caninos esquerdos
                    </label>
                </div>
                <label>Opção 02</label>
                <div class="radio" style="margin-left: 30px;">
                    <label>
                        <input type="radio" name="optionsRadios9" id="optionsRadios1" value="11">Melhorar relacionamento A-P de caninos esquerdos,
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
                        <input type="radio" name="optionsRadios10" id="optionsRadios1" value="11">Manter relação de caninos esquerdos
                    </label>
                </div>
                <label>Opção 02</label>
                <div class="radio" style="margin-left: 30px;">
                    <label>
                        <input type="radio" name="optionsRadios10" id="optionsRadios1" value="11">Melhorar relacionamento A-P de caninos esquerdos,
                        até 1 mm (na ausência de diastemas, DIP porterior será
                        necessário)
                    </label>
                </div>
            </div>
            <div class="col-md-12"><hr/></div>
            <div class="col-md-12">
                <label>
                    8 - SOBRESSALIÊNCIA
                </label>
                <div class="radio">
                    <label>
                        <input type="radio" name="optionsRadios11" id="optionsRadios1" value="11">Mostrar resultados de sobressaliência após alinhamento
                    </label>
                </div>
                <div class="radio">
                    <label>
                        <input type="radio" name="optionsRadios11" id="optionsRadios1" value="22">Manter sobressaliência inicial (pode requerer DIP)
                    </label>
                </div>
                <div class="radio">
                    <label>
                        <input type="radio" name="optionsRadios11" id="optionsRadios1" value="22">Reduzir sobressaliência com DIP
                    </label>
                </div>
            </div>
            <div class="col-md-12"><hr/></div>
            <div class="col-md-12">
                <label>
                    9 - SOBREMORDIDA
                </label>
                <div class="radio">
                    <label>
                        <input type="radio" name="optionsRadios12" id="optionsRadios1" value="11">Mostrar resultados de sobremordida após alinhamento
                    </label>
                </div>
                <div class="radio">
                    <label>
                        <input type="radio" name="optionsRadios12" id="optionsRadios1" value="22">Manter sobremordida inicial (pode requerer DIP)
                </div>
                <div class="radio">
                    <label>
                        <input type="radio" name="optionsRadios12" id="optionsRadios1" value="22">Alterar sobremordida inicial
                    </label>
                </div>
                <div class="col-md-12">&nbsp;</div>
                <label style="margin-left: 30px;">
                    9.1 - Corrigir mordida aberta (deixe em branco caso não se aplique ao seu caso)<br/>
                    PARA EXTRUSÃO E INTRUSÃO, RECOMENDA-SE O USO DE RECURSOS ADICIONAIS, COMO ELÁSTICOS INTERMAXILARES
                    ASSOCIADOS AO TRATAMENTO COM ALINHADORES. O PLANEJAMENTO E EXECUÇÃO DESTES RECURSOS ADICIONAIS
                    SÃO DE INTEIRA RESPONSABILIDADE DO ORTODONTISTA SOLICITANTE EM SEU AMBIENTE CLÍNICO.<br/>
                    Extruir dentes anteriores
                </label>
                <div class="checkbox" style="margin-left: 30px;">
                    <label>
                        <input type="checkbox" value="">Superiores
                    </label>
                </div>
                <div class="checkbox" style="margin-left: 30px;">
                    <label>
                        <input type="checkbox" value="">Inferiores
                    </label>
                </div>
                <div class="col-md-12">&nbsp;</div>
                <label style="margin-left: 30px;">
                    9.2 - Corrigir mordida profunda (deixe em branco caso não se aplique ao seu caso)<br/>
                    PARA EXTRUSÃO E INTRUSÃO, RECOMENDA-SE O USO DE RECURSOS ADICIONAIS, COMO ELÁSTICOS INTERMAXILARES
                    ASSOCIADOS AO TRATAMENTO COM ALINHADORES. O PLANEJAMENTO E EXECUÇÃO DESTES RECURSOS ADICIONAIS
                    SÃO DE INTEIRA RESPONSABILIDADE DO ORTODONTISTA SOLICITANTE EM SEU AMBIENTE CLÍNICO.<br/>
                    Extruir dentes anteriores
                </label>
                <div class="checkbox" style="margin-left: 30px;">
                    <label>
                        <input type="checkbox" value="">Superiores
                    </label>
                </div>
                <div class="checkbox" style="margin-left: 30px;">
                    <label>
                        <input type="checkbox" value="">Inferiores
                    </label>
                </div>
            </div>
            <div class="col-md-12"><hr/></div>
            <div class="col-md-12">
                <label>
                    10 - LINHA MÉDIA
                </label>
                <div class="radio">
                    <label>
                        <input type="radio" name="optionsRadios13" id="optionsRadios1" value="11">Mostrar resultados da linha média após o alinhamento
                    </label>
                </div>
                <div class="radio">
                    <label>
                        <input type="radio" name="optionsRadios13" id="optionsRadios1" value="22">Manter linha média inicial (pode requerer DIP)
                    </label>
                </div>
                <div class="radio">
                    <label>
                        <input type="radio" name="optionsRadios13" id="optionsRadios1" value="22">Corrigir linha média com DIP
                    </label>
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-6">
                    <label>Superior:</label>
                    <select class="form-control">
                        <option>SELECIONE</option>
                        <option>Não alterar</option>
                        <option>Para direita do paciente</option>
                        <option>Para esquerda do paciente</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label>Inferior:</label>
                    <select class="form-control">
                        <option>SELECIONE</option>
                        <option>Não alterar</option>
                        <option>Para direita do paciente</option>
                        <option>Para esquerda do paciente</option>
                    </select>
                </div>
            </div>
            <div class="col-md-12"><hr/></div>
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
                        <input type="radio" name="optionsRadios14" id="optionsRadios1" value="22">Fechar todos os diastemas
                    </label>
                </div>
                <div class="radio">
                    <label>
                        <input type="radio" name="optionsRadios14" id="optionsRadios1" value="22">Fechar todos os diastemas exceto:
                    </label>
                </div>
                <input class="form-control" name="sobre-rot" placeholder="Descreva os dentes">
            </div>
            <div class="col-md-4">
                <label>
                    11.2 - Em caso de discrepância de tamanho dentário:
                </label>
                <div class="radio">
                    <label>
                        <input type="radio" name="optionsRadios15" id="optionsRadios1" value="22">Deixar espaço na mesial dos laterais
                    </label>
                </div>
                <div class="radio">
                    <label>
                        <input type="radio" name="optionsRadios15" id="optionsRadios1" value="22">Deixar espaço na distal dos laterais
                    </label>
                </div>
                <div class="radio">
                    <label>
                        <input type="radio" name="optionsRadios15" id="optionsRadios1" value="22">Deixar espaços igualmente ao redor
                        dos laterais
                    </label>
                </div>
                <div class="radio">
                    <label>
                        <input type="radio" name="optionsRadios15" id="optionsRadios1" value="22">DIP no arco oposto e retração superior
                    </label>
                </div>
            </div>
            <div class="col-md-4">
                <label>
                    11.3 - Para tratamento de casos de fechamento de espaços, realizar sobrecorreção do fechamento (cadeia elástica virtual)
                </label>
                <div class="radio">
                    <label>
                        <input type="radio" name="optionsRadios16" id="optionsRadios1" value="22">Sim
                    </label>
                </div>
                <div class="radio">
                    <label>
                        <input type="radio" name="optionsRadios16" id="optionsRadios1" value="22">Não
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
                <select class="form-control">
                    <option>SELECIONE</option>
                    <option>Primeira opção</option>
                    <option>Quando for necessário após a primeira opção</option>
                    <option>Mínimo necessário</option>
                    <option>Não realizar</option>
                </select>
                <br/>
                <label>
                    Vestibularização incisivos
                </label>
                <select class="form-control">
                    <option>SELECIONE</option>
                    <option>Primeira opção</option>
                    <option>Quando for necessário após a primeira opção</option>
                    <option>Mínimo necessário</option>
                    <option>Não realizar</option>
                </select>
                <br/>
                <label>
                    DIP - Anterior
                </label>
                <select class="form-control">
                    <option>SELECIONE</option>
                    <option>Primeira opção</option>
                    <option>Quando for necessário após a primeira opção</option>
                    <option>Mínimo necessário</option>
                    <option>Não realizar</option>
                </select>
            </div>
            <div class="col-md-6">
                <label>
                    11.4.1 - Correção inferior
                </label>
                <br/>
                <label>
                    Extração transversal
                </label>
                <select class="form-control">
                    <option>SELECIONE</option>
                    <option>Primeira opção</option>
                    <option>Quando for necessário após a primeira opção</option>
                    <option>Mínimo necessário</option>
                    <option>Não realizar</option>
                </select>
                <br/>
                <label>
                    Vestibularização incisivos
                </label>
                <select class="form-control">
                    <option>SELECIONE</option>
                    <option>Primeira opção</option>
                    <option>Quando for necessário após a primeira opção</option>
                    <option>Mínimo necessário</option>
                    <option>Não realizar</option>
                </select>
                <br/>
                <label>
                    DIP - Anterior
                </label>
                <select class="form-control">
                    <option>SELECIONE</option>
                    <option>Primeira opção</option>
                    <option>Quando for necessário após a primeira opção</option>
                    <option>Mínimo necessário</option>
                    <option>Não realizar</option>
                </select>
            </div>
            <div class="col-md-12"><hr/></div>
            <div class="col-md-12">
                <label>
                    12 - EXPANSÃO DO ARCO
                </label>
                <div class="radio">
                    <label>
                        <input type="radio" name="optionsRadios17" id="optionsRadios1" value="11">Aumentar a largura do arco na região de caninos apenas
                    </label>
                </div>
                <div class="radio">
                    <label>
                        <input type="radio" name="optionsRadios17" id="optionsRadios1" value="22">Aumentar a largura do arco na região de caninos e pré-molares
                    </label>
                </div>
                <div class="radio">
                    <label>
                        <input type="radio" name="optionsRadios17" id="optionsRadios1" value="22">Aumentar a largura do arco na região de pré-molares apenas
                    </label>
                </div>
                <div class="radio">
                    <label>
                        <input type="radio" name="optionsRadios17" id="optionsRadios1" value="22">Alinhar o arco com mínima alteração de largura
                    </label>
                </div>
            </div>
            <div class="col-md-12"><hr/></div>
            <div class="col-md-12">
                <label>
                    13 - PREFERÊNCIAS CLÍNICAS PARA O DESGASTE PROXIMAL (DIP)<br/>Recomendações para desgaste interproximal (DIP)
                </label>
                <div class="radio">
                    <label>
                        <input type="radio" name="optionsRadios18" id="optionsRadios1" value="11">Restringir desgaste máximo para 0.3 mm em cada face proximal
                    </label>
                </div>
                <div class="radio">
                    <label>
                        <input type="radio" name="optionsRadios18" id="optionsRadios1" value="22">Restringir desgaste máximo para 0.5 mm em cada face proximal
                    </label>
                </div>
                <div class="radio">
                    <label>
                        <input type="radio" name="optionsRadios18" id="optionsRadios1" value="22">Não restringir desgaste máximo em cada face dentária
                    </label>
                </div>
                <div class="radio">
                    <label>
                        <input type="radio" name="optionsRadios18" id="optionsRadios1" value="22">Desejo um desgaste específico no(s) dente(s)/face(s)
                    </label>
                </div>
                <input class="form-control" name="sobre-rot" placeholder="Descreva os dentes">
            </div>
            <div class="col-md-12"><hr/></div>
            <div class="col-md-12">
                <label>
                    14 - OUTRAS INFORMAÇÕES IMPORTANTES PARA REALIZAÇÃO DO SETUP
                </label>
                <textarea class="form-control" rows="3"></textarea>
            </div>
            <div class="col-md-12"><hr/></div>
            <div class="col-md-12">
                <label>
                    15 - ENVIO DE MODELO FÍSICO<br/>O envio de modelos em gesso só é aceito para confecção de contenções (Smart Retainer), para confecção de alinhadores (Smart Aligner) são apenas aceitas moldagens em silicone de adição e modelos virtuais.
                </label>
                <div class="radio">
                    <label>
                        <input type="radio" name="optionsRadios19" id="optionsRadios1" value="11">Sim
                    </label>
                </div>
                <div class="radio" style="margin-left: 30px;">
                    <label>
                        <input type="radio" name="optionsRadios20" id="optionsRadios1" value="22">Descarte
                    </label>
                </div>
                <div class="radio" style="margin-left: 30px;">
                    <label>
                        <input type="radio" name="optionsRadios20" id="optionsRadios1" value="22">Devolução
                    </label>
                </div>
                <div class="radio">
                    <label>
                        <input type="radio" name="optionsRadios19" id="optionsRadios1" value="22">Não
                    </label>
                </div>
            </div>
            <div class="col-md-12"><hr/></div>
            <div class="col-md-12">
                <label>
                    16 - ANEXE AQUI OS ARQUIVOS OBRIGATÓRIOS<br/>- Modelos digitais por meio de escaneamento intraoral<br/>- Protocolo Fotográfico para planejamento:
                </label>
                <br/><br/>
                <label>
                    1. Foto frontal
                </label>
                <input type="file">
                <br/><br/>
                <label>
                    2. Foto frontal sorrindo
                </label>
                <input type="file">
                <br/><br/>
                <label>
                    3. Foto perfil direito
                </label>
                <input type="file">
                <br/><br/>
                <label>
                    4. Foto oclusal superior
                </label>
                <input type="file">
                <br/><br/>
                <label>
                    5. Foto oclusal inferior
                </label>
                <input type="file">
                <br/><br/>
                <label>
                    6. Foto intrabucal frontal
                </label>
                <input type="file">
                <br/><br/>
                <label>
                    7. Foto intrabucal lado direito
                </label>
                <input type="file">
                <br/><br/>
                <label>
                    8. Foto intrabucal lado esquerdo
                </label>
                <input type="file">
                <br/><br/>
                <label>
                    - Arquivo Complementar<br/>Radiografia panorâmica e cefalométrica de perfil ou Tomografia computadorizada Cone Beam
                </label>
                <br/><br/>
                <label>
                    Paciente Escaneado pelo Scan Service?
                </label>
                <div class="radio">
                    <label>
                        <input type="radio" name="optionsRadios20" id="optionsRadios1" value="11">Sim
                    </label>
                </div>
                <div class="radio">
                    <label>
                        <input type="radio" name="optionsRadios20" id="optionsRadios1" value="11">Não
                    </label>
                </div>
                <input type="file">
            </div>
            <div class="col-md-12"><hr/></div>
            <div class="col-md-12">
                <button type="submit" class="btn btn-primary">Enviar solicitação</button>
                <button type="reset" class="btn btn-default">Resetar formulário</button>
            </div>

        </div><!-- /.panel-->
@endsection
