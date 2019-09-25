<?php

namespace App\Http\Requests;

use App\Rules\Cpf;
use App\Rules\Cro;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * Class CreateDentist
 * @package App\Http\Requests
 * @property string cro
 * @property string phone
 * @property string cpf
 * @property string city
 * @property string state
 * @property string cellphone
 */
class CreateSingleDentist extends FormRequest
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
            'cro' => ['required', new Cro()],
            'cpf' => ['nullable', new Cpf()],
            'city' => 'required',
            'state' => ['required', Rule::in(config('states')),]
        ];
    }
}
