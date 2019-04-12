<?php

namespace App\Http\Requests\Patient;

use App\Patient;
use App\Rules\UniqueSoftDeletes;
use Auth;
use Carbon\Carbon;
use Illuminate\Database\Query\Builder;
use Illuminate\Validation\Rule;

/**
 * Trait BaseValidationTrait
 * @package App\Http\Requests\Patient
 * @property Patient patient
 */
trait BaseValidationTrait
{

    protected $softDeleted = null;

    protected function prepareForValidation()
    {
        $input = $this->all();

        if ($input['birthday']) {
            $input['birthday'] = Carbon::createFromFormat('d/m/Y', $input['birthday'])->format('Y-m-d');
        }

        $this->replace($input);
    }

    public function messages()
    {
        return [
            'email.unique' => 'bosta de mensagem'
        ];
    }

    public function rules()
    {

        $patientId = $this->patient->id ?? null;

        return [
            'name' => ['required'],
            'email' => [
                'email',
                'required',
                new UniqueSoftDeletes('patients', 'email', 'patients.restore', $patientId, []),
            ],
            'birthday' => 'date',
            'city' => 'required',
            'state' => ['required', Rule::in(config('states')),],
            'gender' => 'in:M,F'
        ];
    }
}