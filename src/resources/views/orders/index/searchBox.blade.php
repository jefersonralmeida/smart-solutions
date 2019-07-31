<div class="panel panel-default">
    <div class="panel-body">
        <form method="get" action="{{ route('orders') }}">
            <div class="col-lg-2">
                <label>
                    Data inicial:
                </label>
                <input class="form-control" type="date" name="from_date" value="{{ $filters['from_date'] }}"/>
            </div>
            <div class="col-lg-2">
                <label>
                    Data final:
                </label>
                <input class="form-control" type="date" name="to_date" value="{{ $filters['to_date']}}"/>
            </div>
            <div class="col-lg-2">
                <label>
                    Dentista:
                </label>
                <select class="form-control" style="height: 47px;" name="dentist">
                    <option value="" selected>TODOS</option>
                    @foreach ($dentists as  $dentist)
                        <option value="{{ $dentist->id }}" {{ $dentist->id == $filters['dentist'] ? 'selected' : '' }}>{{ $dentist->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-lg-2">
                <label>
                    Paciente:
                </label>
                <select class="form-control" style="height: 47px;" name="patient">
                    <option value="" selected>TODOS</option>
                    @foreach ($patients as  $patient)
                        <option value="{{ $patient->id }}" {{ $patient->id == $filters['patient'] ? 'selected' : '' }}>{{ $patient->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-lg-2">
                <label>
                    Status:
                </label>
                <select class="form-control" style="height: 47px;" name="status">
                    <option value="" selected>TODOS</option>
                    @foreach (config('status') as $statusId => $status)
                        <option value="{{ $statusId }}" {{ $statusId == $filters['status'] ? 'selected' : '' }}>{{ $status['name'] }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-lg-2">
                <label>
                    <br/>
                </label>
                <button type="submit" class="btn btn-primary" style="margin-top: 30px;">Procurar</button>
            </div>
        </form>
        <div class="col-lg-12">&nbsp;</div>
        <div class="col-lg-12">
            @foreach (config('status') as $status)
                <div class="legenda" style="background-color: {{ $status['color'] }}"></div>
                <div class="pos-legenda">{{ $status['name'] }}</div>
            @endforeach
        </div>
    </div>
</div>