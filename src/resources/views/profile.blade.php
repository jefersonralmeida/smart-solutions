@extends('layouts.main')

@section('content')
    <div class="panel panel-default">
        <div class="panel-body">
            @include('layouts/flash-message')
            <div class="row" style="margin: 10px;">
                <div class="col-lg-2">
                    <img src="{{ route('profile.avatar') }}" class="img-responsive"
                         style="height: 140px; width: 140px;"/>
                    <a href="#changeAvatarForm" data-toggle="collapse">Alterar imagem</a>
                </div>
                <div class="col-lg-10">
                    <div class="row"><h3>Dados Acesso</h3></div>
                    <div class="row">
                        <div class="col-lg-12" style="background-color: #c8e0f0; padding-top: 20px;">
                            <div class="col-lg-6">
                                <p>Nome:&nbsp&nbsp;<b>{{ Auth::user()->name }}</b></p>
                            </div>
                            <div class="col-lg-6">
                                <p>E-mail:&nbsp;&nbsp;<b>{{ Auth::user()->email }}</b></p>
                            </div>
                        </div>
                        @if ($form != 'update-profile' || !$errors->any())
                            <a href="#updateProfileForm" data-toggle="collapse">Alterar dados</a> |
                        @endif
                        <a href="#changePasswordForm" data-toggle="collapse">Alterar senha</a>
                    </div>
                    <hr/>
                    <div class="row">
                        <div class="col-lg-12">
                            <div id="updateProfileForm"
                                 class="{{ ($form == 'update-profile') && old() ? '' : 'collapse' }}">
                                @if ($form == 'update-profile' && $errors->any())
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
                                                   value="{{ $form == 'update-profile' ? old('name') : Auth::user()->name }}"/>
                                        </div>

                                        <div class="form-group">
                                            <label for="email">E-mail:</label>
                                            <input id="email" class="form-control" name="email"
                                                   value="{{ $form == 'update-profile' ? old('email') : Auth::user()->email }}"/>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">

                                    </div>
                                    <div class="col-lg-12">&nbsp;</div>
                                    <div class="col-lg-12">
                                        <button type="submit" class="btn btn-primary">Alterar dados</button>
                                    </div>
                                </form>
                            </div>
                            <div id="changePasswordForm" class="collapse">
                                <form method="POST" action="{{ route('profile.change-password') }}">
                                    @csrf
                                    @method('PUT')

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="old_password">Senha Atual:</label>
                                            <input id="old_password" type="password" class="form-control" name="old_password"
                                                   value=""/>
                                        </div>

                                        <div class="form-group">
                                            <label for="new_password">Nova Senha:</label>
                                            <input id="new_password" type="password" class="form-control" name="new_password"
                                                   value=""/>
                                        </div>

                                        <div class="form-group">
                                            <label for="repeat_password">Nova Senha:</label>
                                            <input id="repeat_password" type="password" class="form-control" name="repeat_password"
                                                   value=""/>
                                        </div>

                                    </div>
                                    <div class="col-lg-6">

                                    </div>
                                    <div class="col-lg-12">&nbsp;</div>
                                    <div class="col-lg-12">
                                        <button type="submit" class="btn btn-primary">Alterar a Senha</button>
                                    </div>
                                </form>
                            </div>
                            <div id="changeAvatarForm"
                                 class="{{ ($form == 'change-avatar') && old() ? '' : 'collapse' }}">
                                @if ($form == 'change-avatar' && $errors->any())
                                    <div class="alert bg-warning" role="alert">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                <form method="POST" action="{{ route('profile.change-avatar') }}" enctype="multipart/form-data">
                                    @csrf

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="avatar">Imagem:</label>
                                            <input id="avatar" type="file" class="form-control" name="avatar"
                                                   value=""/>
                                            <small id="avatarHelp" class="form-text text-muted">Apenas arquivos PNG ou JPG</small>
                                        </div>

                                    </div>
                                    <div class="col-lg-6">

                                    </div>
                                    <div class="col-lg-12">&nbsp;</div>
                                    <div class="col-lg-12">
                                        <button type="submit" class="btn btn-primary">Alterar a imagem</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="row" style="margin: 10px;">
                <div class="col-lg-12">
                    <div class="row"><h3>Dados da Clínica</h3></div>
                    <div class="row">
                        @if (Auth::user()->clinic)
                            <div class="col-lg-12" style="background-color: #c8e0f0; padding-top: 20px;">
                                <div class="col-lg-6">
                                    <p>Nome:&nbsp&nbsp;<b>{{ Auth::user()->clinic->name }}</b></p>
                                    <p>Dentistas:
                                        @if ($dentistsCount = Auth::user()->clinic->dentists->count())
                                            <b><a href="{{ route('dentists') }}">{{ $dentistsCount }}</a></b>
                                        @else
                                            <b>0</b>
                                            @can ('admin-clinic')
                                                (<a href="{{ route('dentists.create') }}">Adicionar</a>)
                                            @endcan
                                        @endif
                                    </p>
                                    @can ('admin-clinic')
                                        <p><b>Você é administrador dessa clínica!</b></p>
                                    @endcan
                                </div>
                                <div class="col-lg-6">
                                    <p>CNPJ:&nbsp;&nbsp;<b>{{ Auth::user()->clinic->cnpj }}</b></p>
                                </div>
                            </div>
                            @if ($form != 'update-clinic' || !$errors->any())
                                <a href="#updateClinicForm" data-toggle="collapse">Alterar dados</a>
                            @endif
                                <div id="updateClinicForm"
                                     class="{{ ($form == 'update-clinic') && old() ? '' : 'collapse' }}">
                                    <hr/>
                                    <div class="col-lg-12" style="margin: 10px">
                                    @if ($form == 'update-clinic' && $errors->any())
                                        <div class="alert bg-warning" role="alert">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                    </div>
                                    <form method="POST" action="{{ route('clinic.update', [Auth::user()->clinic->id]) }}">
                                        @csrf
                                        @method('PUT')

                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="update_clinic_name">Nome da Clínica:</label>
                                                <input id="update_clinic_name" type="text" class="form-control"
                                                       name="name"
                                                       value="{{ $form == 'update-clinic' ? old('name') : Auth::user()->clinic->name }}"/>
                                            </div>
                                            <div class="form-group">
                                                <label for="update_clinic_cnpj">CNPJ:</label>
                                                <input id="update_clinic_cnpj" class="form-control" name="cnpj"
                                                       value="{{ $form == 'update-clinic' ? old('cnpj') : Auth::user()->clinic->cnpj }}"/>
                                            </div>
                                        </div>
                                        <div class="col-lg-6"></div>
                                        <div class="col-lg-12">&nbsp;</div>
                                        <div class="col-lg-12">
                                            <button type="submit" class="btn btn-primary">Alterar dados</button>
                                        </div>
                                    </form>
                                </div>
                        @else
                            <div class="col-lg-12">
                                <p>
                                    Seu usuário não está ligado a nenhuma clínica.
                                    <a href="#createClinicForm" data-toggle="collapse">Crie</a> uma nova clínica ou
                                    <a href="#">solicite o ingresso</a>
                                    em uma clínica existente.
                                </p>
                                <div id="createClinicForm"
                                     class="{{ ($form == 'create-clinic') && old() ? '' : 'collapse' }}">
                                    <hr/>
                                    <h4>Criar Clínica</h4>
                                    @if ($form == 'create-clinic' && $errors->any())
                                        <div class="alert bg-warning" role="alert">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                    <form method="POST" action="{{ route('clinic.store') }}">
                                        @csrf

                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="create_clinic_name">Nome da Clínica:</label>
                                                <input id="create_clinic_name" type="text" class="form-control"
                                                       name="name"
                                                       value="{{ old('name') ?? '' }}"/>
                                            </div>
                                            <div class="form-group">
                                                <label for="create_clinic_cnpj">CNPJ:</label>
                                                <input id="create_clinic_cnpj" class="form-control" name="cnpj"
                                                       value="{{ old('cnpj') ?? '' }}"/>
                                            </div>
                                        </div>
                                        <div class="col-lg-6"></div>
                                        <div class="col-lg-12">&nbsp;</div>
                                        <div class="col-lg-12">
                                            <button type="submit" class="btn btn-primary">Alterar dados</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            @if (Auth::user()->clinic)
                <div class="row" style="margin: 10px;">
                    <div class="col-lg-12">
                        <div class="row"><h3>Endereços</h3></div>
                        <div class="row">
                            @if (Auth::user()->clinic->addresses->count())
                                @foreach(Auth::user()->clinic->addresses as $address)
                                    <div class="col-lg-12">
                                        <hr/>
                                    </div>
                                    @include('addresses.cell', compact('address'))
                                @endforeach
                                <div class="col-lg-12">
                                    <hr/>
                                </div>
                                <div class="col-lg-12">
                                    <a href="{{ route('addresses.create') }}">Adicionar Novo Endereço</a>
                                </div>
                            @else
                                <div class="col-lg-12">
                                    <p>
                                        Sua clínica não tem nenhum endereço ativo.
                                        <a href="{{ route('addresses.create') }}">Inclua</a> pelo menos um
                                        endereço
                                        para poder realizar pedidos.
                                    </p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection

@section ('scripts')
    <script language="javascript">
        $('#update_clinic_cnpj').mask('{{ config('masks.cnpj') }}');
        $('#create_clinic_cnpj').mask('{{ config('masks.cnpj') }}');
    </script>
@endsection
