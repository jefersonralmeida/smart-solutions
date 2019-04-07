<?php

namespace App\Http\Requests\Patient;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class CreatePatient
 * @package App\Http\Requests\Patient
 * @property string name
 * @property string email
 * @property string birthday
 * @property string phone
 * @property string gender
 * @property string city
 * @property string state
 * @property string cellphone
 */
class CreatePatient extends FormRequest
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

}
