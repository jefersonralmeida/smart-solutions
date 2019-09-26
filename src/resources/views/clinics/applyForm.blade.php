@php
    /** @var \Illuminate\Database\Eloquent\Collection|\App\Clinic[] $clinics */
@endphp
@extends('layouts.main')

@section('content')
    <div class="panel panel-default">

        <div class="panel-body">
            <div class="col-lg-12">
                <form method="POST" action="{{ route('clinic.apply') }}">
                    @csrf
                    <div class="col-lg-12">

                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="clinic">
                                    Clínicas disponíveis:
                                </label>
                                <select class="form-control" style="height: 47px;" id="clinic" name="clinic_id">
                                    <option value="">Selecione</option>
                                    @foreach ($clinics as $clinic)
                                        <option value="{{ $clinic->id }}">
                                            {{ $clinic->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Solicitar Ingresso</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')

@endsection
