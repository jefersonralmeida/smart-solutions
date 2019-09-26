<li class="dropdown">
    {{--data-toggle="dropdown"--}}
    <a class="dropdown-toggle count-info" href="#" data-toggle="dropdown">
        <em class="fa fa-bell"></em>
        <span id="notifications-counter" class="label label-info"></span>
    </a>
{{--    @if ($notificationCount)--}}
{{--        <ul class="dropdown-menu dropdown-alerts" style="width: 500px;">--}}
{{--            @foreach (Auth::user()->unreadNotifications as $notification )--}}
{{--                <li>--}}
{{--                    <a href="{{ route('notifications.read', ['notification' => $notification->id]) }}">--}}
{{--                        <div style="margin-bottom: 8px;">--}}
{{--                            <strong>{{ $notification->data['title'] }}</strong>--}}
{{--                            <span class="pull-right text-muted small">{{ $notification->created_at->format('d/m/Y H:i') }}</span>--}}
{{--                        </div>--}}
{{--                        @foreach ($notification->data['message'] as $line)--}}
{{--                            <p>{{ $line }}</p>--}}
{{--                        @endforeach--}}
{{--                    </a>--}}
{{--                </li>--}}
{{--            @endforeach--}}
{{--        </ul>--}}
{{--    @endif--}}
</li>

<script language="javascript">

</script>
