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
class OrderSurgery extends FormRequest
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

        $input['data']['produto'] = 4;

        if (isset($input['data']['tipo_trabalho'])) {
            $input['data']['tipo_trabalho'] = array_keys($input['data']['tipo_trabalho']);
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
            'data.tipo_caso' => 'required',
            'data.tipo_trabalho' => 'required',
        ];
    }
}
