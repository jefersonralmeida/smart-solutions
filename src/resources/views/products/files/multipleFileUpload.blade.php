@php
    /** @var \App\Order $order */
    /** @var string $id */
    /** @var string $label */
    /** @var string[] $presentFiles */
@endphp
<div class="multiple-file-uploader">
@for($i=1; $i <= 10; $i++)
    @include(
        'products.files.singleFileUpload',
        [
            'order' => $order,
            'id' => "{$id}_{$i}",
            'label' => null,
            'hidden' => (($i > 1) && (!in_array("{$id}_{$i}", $presentFiles))),
            'presentFiles' => $presentFiles,
        ]
        )
@endfor
<a href="#" class="add-file" style="margin: 5px 0">Adicionar Arquivo</a> |
<a href="#" class="remove-file" style="margin: 5px 0; display: none">Remover Arquivo</a>
</div>

