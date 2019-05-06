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

                @include('dentists.cell', ['dentist' => $dentist])
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
