@extends('layouts.main')

@section('content')
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="col-lg-12">
                <div class="col-lg-2">
                    <img src="images/avatar/{{ Auth::user()->id }}.png" class="img-responsive"
                         style="height: 140px; width: 140px;"/>
                    <a href="#">Alterar imagem</a>
                </div>
                <div class="col-lg-10">
                    <div class="row">
                        <div class="col-lg-12" style="background-color: #c8e0f0; padding-top: 20px;">
                            <div class="col-lg-6">
                                <p>Nome completo:&nbsp;&nbsp;<b>{{ Auth::user()->name }}</b></p>
                                <p>{{ strtoupper(Auth::user()->document_type) }}
                                    :&nbsp;&nbsp;<b>{{ Auth::user()->cpf_cnpj }}</b></p>
                                <p>E-mail:&nbsp;&nbsp;<b>{{ Auth::user()->email }}</b></p>
                                <p>Telefone:&nbsp;&nbsp;<b>{{ Auth::user()->phone }}</b></p>
                            </div>
                            <div class="col-lg-6">
                                <p>CRO:&nbsp;&nbsp;<b>{{ Auth::user()->cro }}</b></p>
                                <p>Cidade:&nbsp;&nbsp;<b>{{ Auth::user()->city }}</b></p>
                                <p>Estado:&nbsp;&nbsp;<b>{{ Auth::user()->state }}</b></p>
                                <p>Celular:&nbsp;&nbsp;<b>{{ Auth::user()->cellphone }}</b></p>
                            </div>
                        </div>
                        @if (!$errors->any())
                            <a href="#updateProfileForm" data-toggle="collapse">Alterar dados</a>
                        @endif
                    </div>
                </div>
                <div class="col-lg-12">&nbsp;</div>
                <div class="col-lg-12">
                    @if (session('success'))
                        <div class="alert bg-success" role="alert">O dentista foi alterado com sucesso.</div>
                    @endif
                    <div id="updateProfileForm" class="{{ old() ? '' : 'collapse' }}">
                        @if ($errors->any())
                            <div class="alert bg-warning" role="alert">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form method="POST" action="{{ route('profile.update') }}">
                            @csrf
                            @method('PUT')

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="name">Nome do dentista:</label>
                                    <input id="name" type="text" class="form-control" name="name"
                                           value="{{ old('name') ?? Auth::user()->name }}"/>
                                </div>
                                <div class="form-group">
                                    <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                        <label class="btn btn-secondary btn-sm {{ Auth::user()->document_type == 'cpf' ? 'active' : '' }}" for="cpf_cnpj">
                                            <input type="radio" name="label_cpf_cnpj" id="radio_cpf" value="cpf"
                                                   autocomplete="off" {{ Auth::user()->document_type == 'cpf' ? 'checked' : '' }}>
                                            CPF
                                        </label>
                                        <label class="btn btn-secondary btn-sm {{ Auth::user()->document_type == 'cnpj' ? 'active' : '' }}" for="cpf_cnpj">
                                            <input type="radio" name="label_cpf_cnpj" id="radio_cnpj" value="cnpj"
                                                   autocomplete="off" {{ Auth::user()->document_type == 'cnpj' ? 'checked' : '' }}>
                                            CNPJ
                                        </label>
                                    </div>
                                    <input id="cpf_cnpj" class="form-control" name="cpf_cnpj"
                                           value="{{ old('cpf_cnpj') ?? Auth::user()->cpf_cnpj }}" />
                                </div>
                                <div class="form-group">
                                    <label for="email">E-mail:</label>
                                    <input id="email" class="form-control" name="email"
                                           value="{{ old('email') ?? Auth::user()->email }}"/>
                                </div>
                                <div class="form-group">
                                    <label for="phone">Telefone:</label>
                                    <input id="phone" class="form-control" name="phone"
                                           value="{{ old('phone') ?? Auth::user()->phone }}" />
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="cro">CRO:</label>
                                    <input id="cro" class="form-control" name="cro"
                                           value="{{ old('cro') ?? Auth::user()->cro }}"/>
                                </div>
                                <div class="form-group">
                                    <label for="city" style="height: 25px">Cidade:</label>
                                    <input id="city" class="form-control" name="city"
                                           value="{{ old('city') ?? Auth::user()->city }}"/>
                                </div>
                                <div class="form-group">
                                    <label for="state">Estado:</label>
                                    <select id="state" class="form-control" name="state" style="height: 45px;">
                                        @foreach (
                                            config('states')
                                            as $state)
                                            <option
                                                    {{ (old('state') ?? Auth::user()->state) == $state ? 'selected' : '' }}
                                                    value="{{ $state }}"
                                            >
                                                {{ $state }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="cellphone">Celular:</label>
                                    <input id="cellphone" class="form-control" name="cellphone"
                                           value="{{ old('cellphone') ?? Auth::user()->cellphone }}" />
                                </div>
                            </div>
                            <div class="col-lg-12">&nbsp;</div>
                            <div class="col-lg-12">
                                <button type="submit" class="btn btn-primary">Alterar dados</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-12">
                    <h3>Endereços</h3>
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
                <!--
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
                -->
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

@section('scripts')
    <script language="javascript">
        $('#phone').mask('{{ getMask('phone') }}');
        $('#cellphone').mask('{{ getMask('cellphone') }}');
        $('#cpf_cnpj').mask('{{ getMask(Auth::user()->document_type) }}');

        let cpf ='';
        let cnpj = '';
        $('input[type=radio][name=label_cpf_cnpj]').on('change', function() {
            if (this.value == 'cpf') {
                cnpj = $('#cpf_cnpj').val();
                $('#cpf_cnpj').mask('{{ getMask('cpf') }}');
                $('#cpf_cnpj').val(cpf);
            } else {
                cpf = $('#cpf_cnpj').val();
                $('#cpf_cnpj').mask('{{ getMask('cnpj') }}');
                $('#cpf_cnpj').val(cnpj);
            }
        });
    </script>
@endsection
