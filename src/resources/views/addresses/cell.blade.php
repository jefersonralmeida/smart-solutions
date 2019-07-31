@php
    /** @var \App\Address $address */
@endphp

<div class="col-lg-6">
    <p>
        Identificação:&nbsp;&nbsp;<b>{{ $address->identification }}</b>
    </p>
    <p>
        Nome do Receptor:&nbsp;&nbsp;<b>{{ $address->receiver_name }}</b>
    </p>
    <p>
        Endereço:&nbsp;&nbsp;<b>{{ $address->street }}</b>
    </p>
    <p>
        Bairro: <b>{{ $address->district }}</b>
    </p>
    <p>
        Ponto de Referência: <b>{{ $address->reference_point }}</b>
    </p>
    <p>
        <a href="{{ route('addresses.edit', ['address' => $address->id]) }}">Alterar Endereço</a>
    </p>
</div>
<div class="col-lg-6">
    <p>
        CEP:&nbsp;&nbsp;<b class="zip-code">{{ addMask($address->zip_code, '99.999-99') }}</b>
    </p>
    <p>
        Cidade:&nbsp;&nbsp;<b>{{ $address->city }} - {{ $address->state }}</b>
    </p>
    <p>
        Número:&nbsp;&nbsp;<b>{{ $address->street_number }}</b>
    </p>
    <p>
        Complemento:&nbsp;&nbsp;<b>{{ $address->address_details }}</b>
    </p>
    <p>
        Telefone:&nbsp;&nbsp;<b>{{ $address->phone }}</b>
    </p>
</div>

