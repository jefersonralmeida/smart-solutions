@php
    /** @var \App\Order $order */
    /** @var string $id */
    /** @var string $label */
    /** @var bool $hidden */
    /** @var string[] $presentFiles */
@endphp
<div class="single-file-uploader" id="div_{{ $id }}" style="display: {{ ($hidden ?? false) ? 'none' : 'block' }}">
    @if(!empty($label))
    <div class="card-header">
        <label for="{{ $id }}">{{ $label }}</label>
    </div>
    @endif
    <div class="card-body">
        <form method="POST" action="{{ route('orders.uploadFile', [$order->id]) }}"
              enctype="multipart/form-data" class="file-upload-form" id="form_{{ $id }}">
            @csrf
            <div class="row">
                <div class="col-md-4">
                    <input
                        type="file"
                        id="{{ $id }}"
                        name="{{ $id }}"
                        required
                    />
                </div>
                <div class="col-md-1">
                    <input type="submit" value="Enviar" class="btn btn-success">
                </div>
                <div class="col-md-4">
                    <div class="progress">
                        <div class="bar"></div>
                        <div class="percent">0%</div>
                    </div>
                </div>
                @if(in_array($id, $presentFiles))
                    <div class="col-md-3">
                        <a href="{{ route('orders.downloadFile', [$order->id, $id]) }}" class="btn-sm btn-primary"><i class="fa fa-download"></i> Arquivo já enviado.</a>
                    </div>
                @endif
            </div>
        </form>
    </div>
</div>
