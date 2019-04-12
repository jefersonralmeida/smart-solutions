@php
    /** @var \App\Dentist[]|\Illuminate\Database\Eloquent\Collection $dentists */
@endphp
@extends('layouts.main')

@section('content')
    <div class="panel panel-default">

        <div class="panel-body">
            <div class="col-lg-10" style="padding:0;">
                <form method="get" action="{{ route('dentists') }}">
                    <div class="col-lg-6" style="padding:0;">
                        <input class="form-control" name="q" placeholder="Digite o nome, email ou CRO do dentista">
                    </div>
                    <div class="col-lg-2">
                        <button type="submit" class="btn btn-primary" style="margin-top: 6px;">Pesquisar</button>
                    </div>
                </form>
            </div>
            <div class="col-lg-2" style="padding:0; text-align: right">
                <a class="btn btn-primary" href="{{ route('dentists.create') }}">Adicionar Dentista</a>
            </div>

            @if (!$dentists->count())
                <div class="col-lg-12" style="padding:0;">
                    <hr/>
                    @if (!empty($query))
                        <p>Sua busca não retornou resultados.</p>
                    @else
                        <p>Não há dentistas cadastrados para essa clínica. <a
                                    href="{{ route('dentists.create') }}">Cadastre</a>
                            um novo dentista.</p>
                    @endif
                </div>
            @endif

            @foreach ($dentists as $dentist)

                <div class="col-lg-12" style="background-color: #c8e0f0; margin-top: 15px; padding-top: 20px;"
                     id="dentist-row-{{ $dentist->id }}">
                    <div class="col-lg-6">
                        <p>
                            Nome do dentista:&nbsp;&nbsp;<b>{{ $dentist->name }}</b>&nbsp;&nbsp;
                        </p>
                        <p>E-mail:&nbsp;&nbsp;<b>{{ $dentist->email }}</b></p>
                        <p>
                            CRO:&nbsp;&nbsp;<b>{{ $dentist->cro }}</b>&nbsp;&nbsp;
                            @switch($dentist->cro_status)
                                @case('W')
                                @if (now()->subMinutes(5)->greaterThan($dentist->cro_dispatched_at))
                                    <span class="cro-status badge badge-danger bg-danger"
                                          title="A validação do CRO falhou.">Erro</span>
                                    @php
                                        $try = true;
                                    @endphp
                                @else
                                    <span class="cro-status badge badge-warning bg-warning">Em validação</span>
                                @endif
                                @break
                                @case('A')
                                <span class="cro-status badge badge-success bg-success">Aprovado em {{ $dentist->cro_approved_at->format('d/m/Y H:i') }}</span>
                                @break
                                @case('R')
                                <span class="cro-status badge badge-danger bg-danger"
                                      title="{{ $dentist->cro_status_message }}">Reprovado </span>
                                @php
                                    $try = true;
                                @endphp
                                @break
                                @case('E')
                                <span class="cro-status badge badge-danger bg-danger"
                                      title="{{ $dentist->cro_status_message }}">Erro</span>
                                @php
                                    $try = true;
                                @endphp
                                @break
                            @endswitch
                            @if (isset($try))
                                <a href="{{ route('dentists.dispatch-cro-validation', ['dentist' => $dentist->id]) }}"
                                   class="btn btn-link">Tentar Novamente</a>
                            @endif
                        </p>
                        <p>Telefone:&nbsp;&nbsp;<b>{{ $dentist->phone }}</b></p>
                    </div>
                    <div class="col-lg-6">
                        <p>CPF:&nbsp;&nbsp;<b>{{ $dentist->cpf }}</b></p>
                        <p>Cidade:&nbsp;&nbsp;<b>{{ $dentist->city }}</b></p>
                        <p>Estado:&nbsp;&nbsp;<b>{{ $dentist->state }}</b></p>
                        <p>Celular:&nbsp;&nbsp;<b>{{ $dentist->cellphone }}</b></p>
                    </div>
                </div>
                <div class="col-lg-12" style="margin-top: 5px;">
                    <a href="{{ route('dentists.edit', ['dentist' => $dentist->id]) }}" class="btn btn-primary btn-sm">
                        <i class="fa fa-pencil-square-o"></i> Alterar dados
                    </a>
                    <form
                            action="{{ route('dentists.destroy', ['dentist' => $dentist->id]) }}"
                            method="post"
                            style="display:inline;"
                            onsubmit="return confirm('Deseja realmente excluir o dentista {{ $dentist->name }}')"
                    >
                        @csrf
                        @method ('delete')
                        <button type="submit" class="btn btn-danger btn-sm">
                            <i class="fa fa-trash-o"></i> Excluir Dentista
                        </button>
                    </form>
                </div>
            @endforeach
        </div>
    </div>
@endsection

@section('scripts')
    <script language="javascript">
    </script>
@endsection
