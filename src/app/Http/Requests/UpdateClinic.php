<?php

namespace App\Http\Requests;

use App\Rules\Cnpj;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateClinic extends FormRequest
{

    protected $redirect = 'profile/update-clinic';

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
            'name' => ['required', Rule::unique('clinics', 'name')->ignore($this->route('clinic'))],
            'cnpj' => ['required', new Cnpj(), Rule::unique('clinics', 'cnpj')->ignore($this->route('clinic'))],
        ];
    }
}
