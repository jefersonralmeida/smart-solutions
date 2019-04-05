<?php

if (!function_exists('maskPatternMap')) {
    function maskPatternMap(): array
    {
        return [
            '9' => '/^\d/',
            '*' => '/^[a-zA-Z0-9]/',
            'a' => '/^[a-zA-Z]/',
        ];
    }
}

if (!function_exists('addMask')) {
    function addMask(string $inputValue, string $mask): string
    {
        $patternMap = maskPatternMap();
        $output = '';
        $current = $inputValue;
        foreach (str_split($mask) as $maskChar) {
            if (isset($patternMap[$maskChar]) && preg_match($patternMap[$maskChar], $current, $matches)) {
                $output .= $matches[0];
                $current = preg_replace($patternMap[$maskChar], '', $current);
            } else {
                $output .= $maskChar;
            }
        }
        return $output;
    }
}

if (!function_exists('removeMask')) {
    function removeMask(string $inputValue, string $mask): string
    {
        $patternMap = maskPatternMap();
        $output = '';
        $current = $inputValue;
        foreach (str_split($mask) as $maskChar) {
            if (isset($patternMap[$maskChar]) && preg_match($patternMap[$maskChar], $current, $matches)) {
                $output .= $matches[0];
                $current = preg_replace($patternMap[$maskChar], '', $current);
            } else {
                $current = substr($current, 1);
            }
        }
        return $output;
    }
}

if (!function_exists('validateCnpj')) {

    function validateCnpj(string $cnpj): bool
    {
        if (!preg_match('/^\d{2}\.\d{3}\.\d{3}\/\d{4}\-\d{2}$/', $cnpj)) {
            return false;
        }

        $cnpj = removeMask($cnpj, config('masks.cnpj'));

        // Verifica se nenhuma das sequências invalidas abaixo
        // foi digitada. Caso afirmativo, retorna falso
        if ($cnpj == '00000000000000' ||
            $cnpj == '11111111111111' ||
            $cnpj == '22222222222222' ||
            $cnpj == '33333333333333' ||
            $cnpj == '44444444444444' ||
            $cnpj == '55555555555555' ||
            $cnpj == '66666666666666' ||
            $cnpj == '77777777777777' ||
            $cnpj == '88888888888888' ||
            $cnpj == '99999999999999') {
            return false;
        }

        for ($i = 0, $j = 5, $soma = 0; $i < 12; $i++) {
            $soma += $cnpj{$i} * $j;
            $j = ($j == 2) ? 9 : $j - 1;
        }
        $resto = $soma % 11;
        if ($cnpj{12} != ($resto < 2 ? 0 : 11 - $resto))
            return false;
        // Valida segundo dígito verificador
        for ($i = 0, $j = 6, $soma = 0; $i < 13; $i++) {
            $soma += $cnpj{$i} * $j;
            $j = ($j == 2) ? 9 : $j - 1;
        }
        $resto = $soma % 11;
        return $cnpj{13} == ($resto < 2 ? 0 : 11 - $resto);
    }
}

if (!function_exists('validateCpf')) {

    function validateCpf(string $cpf): bool
    {
        if (!preg_match('/^\d{3}\.\d{3}\.\d{3}\-\d{2}$/', $cpf)) {
            return false;
        }

        $cpf = removeMask($cpf, config('masks.cpf'));

        // Verifica se nenhuma das sequências invalidas abaixo
        // foi digitada. Caso afirmativo, retorna falso
        if ($cpf == '00000000000' ||
            $cpf == '11111111111' ||
            $cpf == '22222222222' ||
            $cpf == '33333333333' ||
            $cpf == '44444444444' ||
            $cpf == '55555555555' ||
            $cpf == '66666666666' ||
            $cpf == '77777777777' ||
            $cpf == '88888888888' ||
            $cpf == '99999999999') {
            return false;
            // Calcula os digitos verificadores para verificar se o
            // CPF é válido
        }

        // Calcula e confere primeiro dígito verificador
        for ($i = 0, $j = 10, $soma = 0; $i < 9; $i++, $j--)
            $soma += $cpf{$i} * $j;
        $resto = $soma % 11;
        if ($cpf{9} != ($resto < 2 ? 0 : 11 - $resto))
            return false;
        // Calcula e confere segundo dígito verificador
        for ($i = 0, $j = 11, $soma = 0; $i < 10; $i++, $j--)
            $soma += $cpf{$i} * $j;
        $resto = $soma % 11;
        return $cpf{10} == ($resto < 2 ? 0 : 11 - $resto);

    }
}

if (!function_exists('sanitizeString')) {
    function sanitizeString(string $string): string
    {

        // remove sequence of more then one space and line breaks
        $string = preg_replace('/\s+/', ' ', $string);

        // trimming
        $string = trim($string);

        // removing accents
        $string = preg_replace([
            "/(á|à|ã|â|ä)/",
            "/(Á|À|Ã|Â|Ä)/",
            "/(é|è|ê|ë)/",
            "/(É|È|Ê|Ë)/",
            "/(í|ì|î|ï)/",
            "/(Í|Ì|Î|Ï)/",
            "/(ó|ò|õ|ô|ö)/",
            "/(Ó|Ò|Õ|Ô|Ö)/",
            "/(ú|ù|û|ü)/",
            "/(Ú|Ù|Û|Ü)/",
            "/(ñ)/",
            "/(Ñ)/"
        ], str_split("aAeEiIoOuUnN"),$string);

        return strtoupper($string);
    }
}
