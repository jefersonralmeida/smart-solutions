@php
    /** @var \App\Dentist $dentist */
@endphp
<div class="col-lg-12" style="background-color: #c8e0f0; margin-top: 15px; padding-top: 20px;"
     id="dentist-row-{{ $dentist->id }}">
    <div class="col-lg-6">
        <p>
            Nome do dentista:&nbsp;&nbsp;<b>{{ $dentist->name }}</b>&nbsp;&nbsp;
        </p>
        <p>E-mail:&nbsp;&nbsp;<b>{{ $dentist->email }}</b></p>
        <p>
            CRO:&nbsp;&nbsp;<b>{{ $dentist->cro }}</b>&nbsp;&nbsp;
            @if (config('cro.checkEnabled'))
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