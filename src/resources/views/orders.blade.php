@extends('layouts.main')

@section('content')
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="col-lg-2">
                <label>
                    Data inicial:
                </label>
                <input class="form-control" type="date" name="data-inicial" value="0000-00-00"/>
            </div>
            <div class="col-lg-2">
                <label>
                    Data final:
                </label>
                <input class="form-control" type="date" name="data-final" value="0000-00-00"/>
            </div>
            <div class="col-lg-2">
                <label>
                    Dentista:
                </label>
                <select class="form-control" style="height: 47px;">
                    <option>SELECIONE</option>
                </select>
            </div>
            <div class="col-lg-2">
                <label>
                    Paciente:
                </label>
                <select class="form-control" style="height: 47px;">
                    <option>SELECIONE</option>
                </select>
            </div>
            <div class="col-lg-2">
                <label>
                    Status:
                </label>
                <select class="form-control" style="height: 47px;">
                    <option>SELECIONE</option>
                    <option>Pedido realizado</option>
                    <option>Aguardando aprovação</option>
                    <option>Em produção</option>
                    <option>Despachado</option>
                    <option>Finalizado</option>
                </select>
            </div>
            <div class="col-lg-2">
                <label>
                    <br/>
                </label>
                <button type="submit" class="btn btn-primary" style="margin-top: 30px;">Procurar</button>
            </div>
            <div class="col-lg-12">&nbsp;</div>
            <div class="col-lg-12">
                <div class="legenda" style="background-color: #7bdd59"></div>
                <div class="pos-legenda">Pedido realizado</div>
                <div class="legenda" style="background-color: #59ccdd"></div>
                <div class="pos-legenda">Aguardando aprovação</div>
                <div class="legenda" style="background-color: #ddbb53"></div>
                <div class="pos-legenda">Em produção</div>
                <div class="legenda" style="background-color: #9683d5"></div>
                <div class="pos-legenda">Despachado</div>
                <div class="legenda" style="background-color: #848484"></div>
                <div class="pos-legenda">Finalizado</div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default ">
                <div class="panel-heading" style="background-color: #59ccdd">
                    000000 - Alinhador ortodôntico - Nome do Paciente
                    <span class="pull-right clickable panel-toggle panel-button-tab-left"><em
                                class="fa fa-toggle-up"></em></span></div>
                <div class="panel-body timeline-container">
                    <ul class="timeline">
                        <li>
                            <div class="timeline-badge primary"><em class="glyphicon glyphicon glyphicon-ok"></em></div>
                            <div class="timeline-panel">
                                <div class="timeline-heading">
                                    <h4 class="timeline-title">Planejamento - 00/00/0000</h4>
                                </div>
                                <div class="timeline-body">
                                    <p>Em produção</p>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="timeline-badge primary"><em class="glyphicon glyphicon glyphicon-file"></em>
                            </div>
                            <div class="timeline-panel">
                                <div class="timeline-heading">
                                    <h4 class="timeline-title">Aprovação do setup - 00/00/0000</h4>
                                </div>
                                <div class="timeline-body">
                                    <p>Arquivo: <a href="#">arquivo.pdf</a></p>
                                    <p>Arquivo: <a href="#">arquivo.pdf</a></p>
                                    <p>Arquivo: <a href="#">arquivo.pdf</a></p>
                                    <label>
                                        Comentários:
                                    </label>
                                    <textarea class="form-control"></textarea>
                                    <br/>
                                    <p>Ao aprovar o setup você concorda com os <a href="#">termos de
                                            responsabilidade</a>.</p>
                                    <button type="submit" class="btn">Solicitar alteração</button>
                                    <button type="submit" class="btn btn-primary">Aprovar</button>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="timeline-badge primary"><em class="glyphicon glyphicon glyphicon-wrench"></em>
                            </div>
                            <div class="timeline-panel">
                                <div class="timeline-heading">
                                    <h4 class="timeline-title">Atendimento - 00/00/0000</h4>
                                </div>
                                <div class="timeline-body">
                                    <p>Arquivos enviados</p>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div><!--/.col-->
    </div><!--/.row-->
@endsection
