@component('mail::message')
# Atualização no pedido {{ $order->id }}

O status do pedido {{ $order->id }} mudou de "{{ $oldStatus }}" para "{{ $newStatus }}".

Atenciosamente,<br/>
{{ config('app.name') }}
@endcomponent
