<?php

namespace App\Http\Requests;

use Auth;
use Illuminate\Database\Query\Builder;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateAddress extends FormRequest
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

        $input['identification'] = sanitizeString($input['identification']);
        $input['receiver_name'] = sanitizeString($input['receiver_name']);
        $input['street'] = sanitizeString($input['street']);
        $input['district'] = sanitizeString($input['district']);
        $input['city'] = sanitizeString($input['city']);
        $input['clinic_id'] = Auth::user()->clinic_id;

        $this->replace($input);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'identification' => 'required',
            'receiver_name' => 'required',
            'zip_code' => 'required|regex:/\d{8}/',
            'street' => 'required',
            'street_number' => 'required',
            'city' => 'required',
            'state' => 'required',
        ];
    }
}
