@php
    /** @var \App\Patient[]|\Illuminate\Database\Eloquent\Collection $patients */
@endphp
@extends('layouts.main')

@section('content')
    <div class="panel panel-default">

        <div class="panel-body">
            <div class="col-lg-10" style="padding:0;">
                <form method="get" action="{{ route('patients') }}">
                    <div class="col-lg-6" style="padding:0;">
                        <input class="form-control" name="q" placeholder="Digite o nome ou email do paciente">
                    </div>
                    <div class="col-lg-2">
                        <button type="submit" class="btn btn-primary" style="margin-top: 6px;">Pesquisar</button>
                    </div>
                </form>
            </div>
            <div class="col-lg-2" style="padding:0; text-align: right">
                <a class="btn btn-primary" href="{{ route('patients.create') }}">Adicionar Paciente</a>
            </div>

            @if (!$patients->count())
                <div class="col-lg-12" style="padding:0;">
                    <hr/>
                    @if (!empty($query))
                        <p>Sua busca por '{{ $query }}' não retornou resultados.</p>
                    @else
                        <p>Não há dentistas cadastrados para essa clínica. <a
                                    href="{{ route('patients.create') }}">Cadastre</a>
                            um novo dentista.</p>
                    @endif
                </div>
            @endif

            @if (!empty($query))
                <div class="col-lg-12" style="padding:0; margin-top: 10px;">
                    <p>Resultados da busca: '<strong>{{ $query }}</strong>'</p>
                </div>
            @endif

            @foreach ($patients as $patient)

                <div class="col-lg-12" style="background-color: #c8e0f0; margin-top: 15px; padding-top: 20px;"
                     id="dentist-row-{{ $patient->id }}">
                    <div class="col-lg-6">
                        <p>Nome do paciente:&nbsp;&nbsp;<b>{{ $patient->name }}</b></p>
                        <p>Data de Nascimento: <b>{{ $patient->birthday->format('d/m/Y') }}</b></p>
                        <p>E-mail:&nbsp;&nbsp;<b>{{ $patient->email }}</b></p>
                        <p>Telefone:&nbsp;&nbsp;<b>{{ $patient->phone }}</b></p>
                    </div>
                    <div class="col-lg-6">
                        <p>Cidade:&nbsp;&nbsp;<b>{{ $patient->city }}</b></p>
                        <p>Estado:&nbsp;&nbsp;<b>{{ $patient->state }}</b></p>
                        <p>Sexo: <b>{{ $patient->gender }}</b></p>
                        <p>Celular:&nbsp;&nbsp;<b>{{ $patient->cellphone }}</b></p>
                    </div>
                </div>
                <div class="col-lg-12" style="margin-top: 5px;">
                    <a href="{{ route('patients.edit', ['patient' => $patient->id]) }}" class="btn btn-primary btn-sm">
                        <i class="fa fa-pencil-square-o"></i> Alterar dados
                    </a>
                    <form
                            action="{{ route('patients.destroy', ['patient' => $patient->id]) }}"
                            method="post"
                            style="display:inline;"
                            onsubmit="return confirm('Deseja realmente excluir o dentista {{ $patient->name }}')"
                    >
                        @csrf
                        @method ('delete')
                        <button type="submit" class="btn btn-danger btn-sm">
                            <i class="fa fa-trash-o"></i> Excluir Paciente
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
