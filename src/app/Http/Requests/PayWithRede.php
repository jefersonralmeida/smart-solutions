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
