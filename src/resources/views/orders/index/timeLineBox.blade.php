@php
    /** @var \App\Order $order */
@endphp
<div class="panel-body timeline-container">
    <ul class="timeline">
        @foreach ($order->status_history as $entry)
        <li>
            <div class="timeline-badge primary"><em class="glyphicon glyphicon glyphicon-ok"></em></div>
            <div class="timeline-panel">
                <div class="timeline-heading">
                    <h4 class="timeline-title">{{ $entry['status'] }} - {{ $entry['date'] }}</h4>
                </div>
                <div class="timeline-body">
                    <p></p>
                </div>
            </div>
        </li>
        @endforeach
        {{--<li>--}}
            {{--<div class="timeline-badge primary"><em class="glyphicon glyphicon glyphicon-file"></em>--}}
            {{--</div>--}}
            {{--<div class="timeline-panel">--}}
                {{--<div class="timeline-heading">--}}
                    {{--<h4 class="timeline-title">Aprovação do setup - 00/00/0000</h4>--}}
                {{--</div>--}}
                {{--<div class="timeline-body">--}}
                    {{--<p>Arquivo: <a href="#">arquivo.pdf</a></p>--}}
                    {{--<p>Arquivo: <a href="#">arquivo.pdf</a></p>--}}
                    {{--<p>Arquivo: <a href="#">arquivo.pdf</a></p>--}}
                    {{--<label>--}}
                        {{--Comentários:--}}
                    {{--</label>--}}
                    {{--<textarea class="form-control"></textarea>--}}
                    {{--<br/>--}}
                    {{--<p>Ao aprovar o setup você concorda com os <a href="#">termos de--}}
                            {{--responsabilidade</a>.</p>--}}
                    {{--<button type="submit" class="btn">Solicitar alteração</button>--}}
                    {{--<button type="submit" class="btn btn-primary">Aprovar</button>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</li>--}}
        {{--<li>--}}
            {{--<div class="timeline-badge primary"><em class="glyphicon glyphicon glyphicon-wrench"></em>--}}
            {{--</div>--}}
            {{--<div class="timeline-panel">--}}
                {{--<div class="timeline-heading">--}}
                    {{--<h4 class="timeline-title">Atendimento - 00/00/0000</h4>--}}
                {{--</div>--}}
                {{--<div class="timeline-body">--}}
                    {{--<p>Arquivos enviados</p>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</li>--}}
    </ul>
</div>