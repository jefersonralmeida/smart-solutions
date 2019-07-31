@php
    /** @var \App\Patient[]|\Illuminate\Database\Eloquent\Collection $patients */
    /** @var \App\Dentist[]|\Illuminate\Database\Eloquent\Collection $dentists */
    /** @var \Illuminate\Support\ViewErrorBag $errors */
@endphp
<div class="col-md-6">
    <div class="form-group">
        <label for="patient">PACIENTE</label>
        <select id="patient" name="patient_id" class="form-control is-invalid">
            <option value="">SELECIONE</option>

            @foreach ($patients as $patient)
                <option
                        {{ (old('patient_id')) == $patient->id ? 'selected' : '' }}
                        value="{{ $patient->id }}"
                >
                    {{ "{$patient->name}  | {$patient->email}" }}
                </option>
            @endforeach
        </select>
        <small class="form-text text-danger">
            {{ $errors->first('patient') }}
        </small>
        <div><a href="{{ route('patients.create') }}">Adicionar paciente</a></div>
    </div>
</div>
<div class="col-md-6">
    <div class="form-group">
        <label for="dentist">DENTISTA</label>
        <select id="dentist" name="dentist_id" class="form-control">
            <option value="">SELECIONE</option>
            @foreach ($dentists as $dentist)
                <option
                        {{ (old('dentist_id')) == $dentist->id ? 'selected' : '' }}
                        value="{{ $dentist->id }}"
                >
                    {{ "{$dentist->name}  | {$dentist->cro}" }}
                </option>
            @endforeach
        </select>
        <small class="form-text text-danger">
            {{ $errors->first('dentist') }}
        </small>
        <div><a href="{{ route('dentists.create') }}">Adicionar dentista</a></div>
    </div>
</div>