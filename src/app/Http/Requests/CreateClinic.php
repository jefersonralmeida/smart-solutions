<?php

namespace App\Http\Requests;

use App\Rules\Cnpj;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Waavi\Sanitizer\Laravel\SanitizesInput;

class CreateClinic extends FormRequest
{

    use SanitizesInput;

    protected $redirect = 'profile/create-clinic';

    public function filters()
    {
        return [
            'cnpj' => 'digit'
        ];
    }

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
            'name' => ['required', Rule::unique('clinics', 'name')],
            'cnpj' => ['required', new Cnpj(), Rule::unique('clinics', 'cnpj')],
        ];
    }
}
