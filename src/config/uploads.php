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
            'file_tomografia_computadorizada_cone_bean',
            'file_perfil_direito_esquerdo_labio_relaxado',
            'file_perfil_direito_esquerdo_sorrindo',
            'file_frontal_boca_relaxada',
            'file_frontal_boca_levemente_aberta',
            'file_frontal_sorrindo',
            'file_sub_mento_vertix_boca_fechada',
            'file_sub_mento_vertix_boca_aberta',
            'file_modelos_digitalizados_oclusao_inicial_mandibula',
            'file_modelos_digitalizados_oclusao_inicial_maxila',
            'file_modelos_digitalizados_oclusao_inicial_registro_mordida',
            'file_modelos_digitalizados_oclusao_final_mandibula',
            'file_modelos_digitalizados_oclusao_final_maxila',
            'file_modelos_digitalizados_oclusao_final_registro_mordida',
        ],
        'required' => [
            'file_tomografia_computadorizada_cone_bean',
            'file_perfil_direito_esquerdo_labio_relaxado',
            'file_perfil_direito_esquerdo_sorrindo',
            'file_frontal_boca_relaxada',
            'file_frontal_boca_levemente_aberta',
            'file_frontal_sorrindo',
            'file_sub_mento_vertix_boca_fechada',
            'file_sub_mento_vertix_boca_aberta',
            'file_modelos_digitalizados_oclusao_inicial_mandibula',
            'file_modelos_digitalizados_oclusao_inicial_maxila',
            'file_modelos_digitalizados_oclusao_final_mandibula',
            'file_modelos_digitalizados_oclusao_final_maxila',
        ],
        'multiple' => [
            'file_tomografia_computadorizada_cone_bean',
            'file_perfil_direito_esquerdo_labio_relaxado',
            'file_perfil_direito_esquerdo_sorrindo',
            'file_frontal_boca_relaxada',
            'file_frontal_boca_levemente_aberta',
            'file_frontal_sorrindo',
            'file_sub_mento_vertix_boca_fechada',
            'file_sub_mento_vertix_boca_aberta',
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
