<?php

namespace App\Http\Requests\Dentist;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class CreateDentist
 * @package App\Http\Requests
 * @property string name
 * @property string email
 * @property string cro
 * @property string phone
 * @property string cpf
 * @property string city
 * @property string state
 * @property string cellphone
 * @property int user_id
 */
class CreateDentist extends FormRequest
{
    use BaseValidationTrait;

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
        return $this->baseRules();
    }
}
