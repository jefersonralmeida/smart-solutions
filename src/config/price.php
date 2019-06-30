<?php

return [

    // smart aligner
    1 => function (\Illuminate\Foundation\Http\FormRequest $request, array $prices) {
        return $prices['smart_aligner_6'];
    },

    // implant guiada
    3 => function (\Illuminate\Foundation\Http\FormRequest $request, array $prices) {
        return $prices['price'];
    },

    // surgery
    4 => function (\Illuminate\Foundation\Http\FormRequest $request, array $prices) {
        return $prices['price'];
    },

    // ROG
    6 => function (\Illuminate\Foundation\Http\FormRequest $request, array $prices) {
        return $prices['price'];
    },

    // Esthetic
    7 => function (\Illuminate\Foundation\Http\FormRequest $request, array $prices) {
        return $prices['price'];
    },

    // Aligner pre protese
    8 => function (\Illuminate\Foundation\Http\FormRequest $request, array $prices) {
        return $prices['price'];
    },
];