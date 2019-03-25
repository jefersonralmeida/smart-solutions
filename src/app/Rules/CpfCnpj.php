<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class CpfCnpj implements Rule
{

    /**
     * @var string
     */
    protected $documentType;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value): bool
    {
        if (preg_match('/^\d{3}\.\d{3}\.\d{3}\-\d{2}$/', $value)) {
            $this->documentType = 'CPF';
            return validateCpf($value);
        }
        $this->documentType = 'CNPJ';
        return validateCnpj($value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return "O {$this->documentType} informado é inválido.";
    }
}
