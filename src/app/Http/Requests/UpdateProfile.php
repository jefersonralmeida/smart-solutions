<?php

namespace App\Http\Requests;

use Auth;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * Class UpdateProfile
 * @package App\Http\Requests
 * @property string $name
 * @property string $cpf_cnpj
 * @property string $email
 * @property string $phone
 * @property string $cro
 * @property string $city
 * @property string $state
 * @property string $cellphone
 */
class UpdateProfile extends FormRequest
{

    protected $redirect = 'profile/update-profile';

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
            'name' => 'required',
            'email' => ['required', 'email', Rule::unique('users', 'email')->ignore(Auth::user()->id)],
        ];
    }
}
