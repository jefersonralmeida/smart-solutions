<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class Cro implements Rule
{
    protected $message = 'CRO inválido.';

    protected $nameAttribute;

    /**
     * Create a new rule instance.
     *
     * @param string $nameAttribute
     */
    public function __construct(string $nameAttribute = 'name')
    {
        $this->nameAttribute = $nameAttribute;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $value = strtoupper(trim($value));

        if (!preg_match('/^([A-Z]{2})\-\d+$/', $value, $matches)) {
            $this->message = "O CRO informado está mal formado. Use o Formato 'UF-9999'";
            return false;
        }

        if (!in_array($matches[1], config('states'))) {
            $this->message = "O CRO informado tem UF inválida.";
            return false;
        }

        if (!empty(request()->state) && $matches[1] !== request()->state) {
            $this->message = "O CRO informado tem UF diferente do cadastro.";
            return false;
        }

        return true;

    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return $this->message;
    }
}
