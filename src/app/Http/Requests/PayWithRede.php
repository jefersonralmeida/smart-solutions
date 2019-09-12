<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class PayWithRede
 * @package App\Http\Requests
 * @property float amount
 * @property string card_number
 * @property string card_holder
 * @property string expiration
 * @property string security_code
 */
class PayWithRede extends FormRequest
{

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    public function messages()
    {
        return [
            'card_number.required' => 'O campo "Número do Cartão" é obrigatório.',
            'card_holder.required' => 'O campo "Nome Impresso no Cartão" é obrigatório.',
            'expiration.required' => 'O campo "Validade" é obrigatório.',
            'expiration.required' => 'O campo "Validade" deve estar no formato mm/aa.',
            'security_code.required' => 'O campo "Código de segurança" é obrigatório.',
            'security_code.integer' => 'O campo "Código de segurança" deve conter um número inteiro.',
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'card_number' => 'required',
            'card_holder' => 'required',
            'expiration' => 'required|regex:/^[0-9]{2}\/[0-9]{2}$/',
            'security_code' => 'required|integer',
            'amount' => 'required|numeric'
        ];
    }
}
