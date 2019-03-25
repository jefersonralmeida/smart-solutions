<?php

namespace App\Rules;

use App\ExternalApi\Cro\CroApiContract;
use Illuminate\Contracts\Validation\Rule;

class Cro implements Rule
{
    protected $message = 'CRO inválido.';

    protected $nameAttribute;

    /**
     * @var CroApiContract
     */
    protected $api;

    /**
     * Create a new rule instance.
     *
     * @param string $nameAttribute
     */
    public function __construct(string $nameAttribute = 'name', CroApiContract $api)
    {
        $this->nameAttribute = $nameAttribute;
        $this->api = $api;
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
        $value = trim($value);

        if (!preg_match('/^[A-Z]{2}\-[A-Z]{2,}\-\d+$/', $value)) {
            $this->message = "O CRO informado está mal formado. Use o Formato 'UF-XX-9999'";
            return false;
        }

        $apiResponse = $this->api->request($value);

        if (!$apiResponse) {
            return false;
        }

        if (!$apiResponse->isActive()) {
            $this->message = 'CRO inativo.';
            return false;
        }

        if ($apiResponse->getName() !== sanitizeString(request()->get('name'))) {
            $this->message = 'O nome registrado no CRO não confere com o nome do cadastro.';
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
