@extends('layouts.main')

@section('content')
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="col-lg-12">
                <div class="col-lg-2">
                    <img src="images/avatar.jpg" class="img-responsive"/>
                    <a href="#">Alterar imagem</a>
                </div>
                <div class="col-lg-10">
                    <div class="row">
                        <div class="col-lg-12" style="background-color: #c8e0f0; padding-top: 20px;">
                            <div class="col-lg-6">
                                <p>Nome completo:&nbsp;&nbsp;<b>Dentista Teste</b></p>
                                <p>CPF/CNPJ:&nbsp;&nbsp;<b>00000</b></p>
                                <p>E-mail:&nbsp;&nbsp;<b>dentista@teste.com.br</b></p>
                                <p>Telefone:&nbsp;&nbsp;<b>021 0000-0000</b></p>
                            </div>
                            <div class="col-lg-6">
                                <p>CRO:&nbsp;&nbsp;<b>00000</b></p>
                                <p>Cidade:&nbsp;&nbsp;<b>Rio de Janeiro</b></p>
                                <p>Estado:&nbsp;&nbsp;<b>RJ</b></p>
                                <p>Celular:&nbsp;&nbsp;<b>021 00000-0000</b></p>
                            </div>
                        </div>
                        <a href="#">Alterar dados</a>
                    </div>
                </div>
                <div class="col-lg-12">&nbsp;</div>
                <div class="col-lg-12">
                    <div class="alert bg-warning" role="alert">Os campos:
                        <li>Item 1</li>
                        <li>Item 1</li>
                        são obrigatórios.
                    </div>

                    <div class="alert bg-danger" role="alert">Dentista já cadastrado.</div>

                    <div class="alert bg-success" role="alert">O dentista foi alterado com sucesso.</div>

                    <div class="col-lg-6">
                        <label>
                            Nome do dentista:
                        </label>
                        <input class="form-control" name="buscar-dentista" value="Dentista teste"/>
                        <label>
                            CPF/CNPJ:
                        </label>
                        <input class="form-control" name="buscar-dentista" value="000000"/>
                        <label>
                            E-mail:
                        </label>
                        <input class="form-control" name="buscar-dentista" value="dentista@teste.com.br"/>
                        <label>
                            Telefone:
                        </label>
                        <input class="form-control" name="buscar-dentista" value="021 0000-0000"/>
                    </div>
                    <div class="col-lg-6">
                        <label>
                            CRO:
                        </label>
                        <input class="form-control" name="buscar-dentista" value="000000"/>
                        <label>
                            Cidade:
                        </label>
                        <input class="form-control" name="buscar-dentista" value="Rio de Janeiro"/>
                        <label>
                            Estado:
                        </label>
                        <select class="form-control" style="height: 47px;">
                            <option>RJ</option>
                        </select>
                        <label>
                            Celular:
                        </label>
                        <input class="form-control" name="buscar-dentista" value="021 00000-0000"/>
                    </div>
                    <div class="col-lg-12">&nbsp;</div>
                    <div class="col-lg-12">
                        <button type="submit" class="btn btn-primary">Alterar dados</button>
                    </div>
                </div>
                <div class="col-lg-12">
                    <h3>Endereços adicionais</h3>
                </div>
                <div class="col-lg-12">
                    <button type="submit" class="btn btn-primary">Adicionar endereços</button>
                </div>
                <div class="col-lg-12">&nbsp;</div>
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-12" style="background-color: #c8e0f0; padding-top: 20px;">
                            <div class="col-lg-6">
                                <p>Identificação:&nbsp;&nbsp;<b>Nome do local</b></p>
                                <p>Nome do Receptor:&nbsp;&nbsp;<b>Nome do receptor</b></p>
                                <p>Endereço:&nbsp;&nbsp;<b>Av. endereço</b></p>
                                <p>Bairro:&nbsp;&nbsp;<b>Bairro</b></p>
                                <p>Ponto de referência:&nbsp;&nbsp;<b>Local perto de tal lugar</b></p>
                            </div>
                            <div class="col-lg-6">
                                <p>CEP:&nbsp;&nbsp;<b>00000-000</b></p>
                                <p>Cidade:&nbsp;&nbsp;<b>Rio de Janeiro</b>&nbsp;&nbsp;Estado:&nbsp;&nbsp;<b>RJ</b></p>
                                <p>Número:&nbsp;&nbsp;<b>0000</b></p>
                                <p>Complemento:&nbsp;&nbsp;<b>Sala 000</b></p>
                                <p>Telefone:&nbsp;&nbsp;<b>021 00000-0000</b></p>
                            </div>
                        </div>
                        <a href="#">Alterar dados</a>
                    </div>
                </div>
                <div class="col-lg-12">&nbsp;</div>

                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-12" style="background-color: #c8e0f0; padding-top: 20px;">
                            <div class="col-lg-6">
                                <p>Identificação:&nbsp;&nbsp;<b>Nome do local</b></p>
                                <p>Nome do Receptor:&nbsp;&nbsp;<b>Nome do receptor</b></p>
                                <p>Endereço:&nbsp;&nbsp;<b>Av. endereço</b></p>
                                <p>Bairro:&nbsp;&nbsp;<b>Bairro</b></p>
                                <p>Ponto de referência:&nbsp;&nbsp;<b>Local perto de tal lugar</b></p>
                            </div>
                            <div class="col-lg-6">
                                <p>CEP:&nbsp;&nbsp;<b>00000-000</b></p>
                                <p>Cidade:&nbsp;&nbsp;<b>Rio de Janeiro</b>&nbsp;&nbsp;Estado:&nbsp;&nbsp;<b>RJ</b></p>
                                <p>Número:&nbsp;&nbsp;<b>0000</b></p>
                                <p>Complemento:&nbsp;&nbsp;<b>Sala 000</b></p>
                                <p>Telefone:&nbsp;&nbsp;<b>021 00000-0000</b></p>
                            </div>
                        </div>
                        <a href="#">Alterar dados</a>
                    </div>
                </div>
                <div class="col-lg-12">&nbsp;</div>

                <div class="col-lg-12">
                    <div class="alert bg-warning" role="alert">Os campos:
                        <li>Item 1</li>
                        <li>Item 1</li>
                        são obrigatórios.
                    </div>

                    <div class="alert bg-danger" role="alert">Endereço já cadastrado.</div>

                    <div class="alert bg-success" role="alert">O endereço foi alterado com sucesso.</div>

                    <div class="col-lg-6">
                        <label>
                            Identificação:
                        </label>
                        <input class="form-control" name="buscar-dentista" value="Nome do local"/>
                        <label>
                            Nome do receptor:
                        </label>
                        <input class="form-control" name="buscar-dentista" value="Nome do receptor"/>
                        <label>
                            Endereço:
                        </label>
                        <input class="form-control" name="buscar-dentista" value="Av. endereço"/>
                        <label>
                            Bairro:
                        </label>
                        <input class="form-control" name="buscar-dentista" value="Bairro"/>
                        <label>
                            Ponto de referência:
                        </label>
                        <input class="form-control" name="buscar-dentista" value="Local perto de tal lugar"/>
                        <label>
                            Telefone:
                        </label>
                        <input class="form-control" name="buscar-dentista" value="021 000000-0000"/>
                    </div>
                    <div class="col-lg-6">
                        <label>
                            CEP:
                        </label>
                        <input class="form-control" name="buscar-dentista" value="00000-000"/>
                        <label>
                            Cidade:
                        </label>
                        <input class="form-control" name="buscar-dentista" value="Rio de Janeiro"/>
                        <label>
                            Estado:
                        </label>
                        <select class="form-control" style="height: 47px;">
                            <option>RJ</option>
                        </select>
                        <label>
                            Número:
                        </label>
                        <input class="form-control" name="buscar-dentista" value="0000"/>
                        <label>
                            Complemento:
                        </label>
                        <input class="form-control" name="buscar-dentista" value="Sala 000"/>

                    </div>
                    <div class="col-lg-12">&nbsp;</div>
                    <div class="col-lg-12">
                        <button type="submit" class="btn btn-primary">Alterar dados</button>
                    </div>
                </div>
                <div class="col-lg-12">&nbsp;</div>

                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-12" style="background-color: #c8e0f0; padding-top: 20px;">
                            <div class="col-lg-6">
                                <p>Identificação:&nbsp;&nbsp;<b>Nome do local</b></p>
                                <p>Nome do Receptor:&nbsp;&nbsp;<b>Nome do receptor</b></p>
                                <p>Endereço:&nbsp;&nbsp;<b>Av. endereço</b></p>
                                <p>Bairro:&nbsp;&nbsp;<b>Bairro</b></p>
                                <p>Ponto de referência:&nbsp;&nbsp;<b>Local perto de tal lugar</b></p>
                            </div>
                            <div class="col-lg-6">
                                <p>CEP:&nbsp;&nbsp;<b>00000-000</b></p>
                                <p>Cidade:&nbsp;&nbsp;<b>Rio de Janeiro</b>&nbsp;&nbsp;Estado:&nbsp;&nbsp;<b>RJ</b></p>
                                <p>Número:&nbsp;&nbsp;<b>0000</b></p>
                                <p>Complemento:&nbsp;&nbsp;<b>Sala 000</b></p>
                                <p>Telefone:&nbsp;&nbsp;<b>021 00000-0000</b></p>
                            </div>
                        </div>
                        <a href="#">Alterar dados</a>
                    </div>
                </div>
                <div class="col-lg-12">&nbsp;</div>

            </div>
        </div>
    </div>
@endsection
