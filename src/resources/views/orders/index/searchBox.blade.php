<div class="panel panel-default">
    <div class="panel-body">
        <div class="col-lg-2">
            <label>
                Data inicial:
            </label>
            <input class="form-control" type="date" name="data-inicial" value="0000-00-00"/>
        </div>
        <div class="col-lg-2">
            <label>
                Data final:
            </label>
            <input class="form-control" type="date" name="data-final" value="0000-00-00"/>
        </div>
        <div class="col-lg-2">
            <label>
                Dentista:
            </label>
            <select class="form-control" style="height: 47px;">
                <option>SELECIONE</option>
            </select>
        </div>
        <div class="col-lg-2">
            <label>
                Paciente:
            </label>
            <select class="form-control" style="height: 47px;">
                <option>SELECIONE</option>
            </select>
        </div>
        <div class="col-lg-2">
            <label>
                Status:
            </label>
            <select class="form-control" style="height: 47px;">
                <option>SELECIONE</option>
                <option>Pedido realizado</option>
                <option>Aguardando aprovação</option>
                <option>Em produção</option>
                <option>Despachado</option>
                <option>Finalizado</option>
            </select>
        </div>
        <div class="col-lg-2">
            <label>
                <br/>
            </label>
            <button type="submit" class="btn btn-primary" style="margin-top: 30px;">Procurar</button>
        </div>
        <div class="col-lg-12">&nbsp;</div>
        <div class="col-lg-12">
            @foreach (config('status') as $status)
            <div class="legenda" style="background-color: {{ $status['color'] }}"></div>
            <div class="pos-legenda">{{ $status['name'] }}</div>
            @endforeach
        </div>
    </div>
</div>