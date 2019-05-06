@php
    /** @var \App\Patient $patient */
@endphp
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