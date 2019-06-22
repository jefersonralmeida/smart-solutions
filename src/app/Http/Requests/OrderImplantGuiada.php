<?php

namespace App\Http\Requests;

use App\Dentist;
use App\Patient;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * Class OrderAligner
 * @package App\Http\Requests
 * @property int dentist_id
 * @property int patient_id
 * @property array data
 */
class OrderImplantGuiada extends FormRequest
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

    protected function prepareForValidation()
    {
        $input = $this->all();

        $input['data']['produto'] = 3;

        if (isset($input['data']['protese'])) {
            $input['data']['protese'] = array_keys($input['data']['protese']);
        }

        if (isset($input['data']['sistema_implante'])) {
            $input['data']['sistema_implante'] = array_keys($input['data']['sistema_implante']);
        }

        $this->replace($input);
    }

    public function messages()
    {
        return [
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
            'patient_id' => ['required', Rule::in(Patient::all()->pluck('id')->toArray())],
            'dentist_id' => ['required', Rule::in(Dentist::approved()->get()->pluck('id')->toArray())],
            'data.protese' => 'required',
            'data.sistema_implante' => 'required',
        ];
    }
}
