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
class OrderAlignerPP extends FormRequest
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
//        $input = $this->all();
//        // change the input here
//        $this->replace($input);
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
        ];
    }
}
