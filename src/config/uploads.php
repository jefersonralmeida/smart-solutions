<?php
/*
 * As chaves sao os ids dos produtos
 */
return [

    // smart aligner
    1 => [
        'files' => [
            'file_foto_frontal',
            'file_foto_frontal_sorrindo',
            'file_foto_perfil_direito',
            'file_foto_oclusal_superior',
            'file_foto_oclusal_inferior',
            'file_foto_intrabucal_frontal',
            'file_foto_intrabucal_lado_direito',
            'file_foto_intrabucal_lado_esquerdo',
            'file_arquivo_complementar',
            'file_scan_service_mandibula',
            'file_scan_service_maxila',
            'file_scan_service_registro_mordida',
        ],
        'required' => [
            'file_foto_frontal',
            'file_foto_frontal_sorrindo',
            'file_foto_perfil_direito',
            'file_foto_oclusal_superior',
            'file_foto_oclusal_inferior',
            'file_foto_intrabucal_frontal',
            'file_foto_intrabucal_lado_direito',
            'file_foto_intrabucal_lado_esquerdo',
            'file_scan_service_mandibula',
            'file_scan_service_maxila',
        ],
        'multiple' => [
            'file_arquivo_complementar'
        ]
    ],

    // surgery
    4 => [
        'files' => [

        ],
        'required' => [

        ],
        'multiple' => [

        ]
    ],

    // Implant Guiada
    3 => [
        'files' => [
            'file_escaneamento_intraoral_mandibula',
            'file_escaneamento_intraoral_maxila',
            'file_escaneamento_intraoral_registro_mordida',
            'file_tomografia_computadorizada_cone_bean'
        ],
        'required' => [
            'file_escaneamento_intraoral_mandibula',
            'file_escaneamento_intraoral_maxila',
        ],
        'multiple' => [
            'file_tomografia_computadorizada_cone_bean'
        ]
    ],

    // Implant ROG
    6 => [
        'files' => [
            'file_tomografia_computadorizada_cone_bean'
        ],
        'required' => [],
        'multiple' => [
            'file_tomografia_computadorizada_cone_bean'
        ]
    ],

    // Esthetic
    7 => [
        'files' => [

        ],
        'required' => [

        ],
        'multiple' => [

        ]
    ],
];
