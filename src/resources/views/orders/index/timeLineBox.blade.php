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
    </ul>
</div>
