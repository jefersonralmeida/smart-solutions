<?php

namespace App\Http\Requests\Dentist;

use App\Rules\Cpf;
use App\Rules\Cro;
use Auth;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Validation\Rule;

trait BaseValidationTrait
{
    protected function baseRules()
    {
        return [
            'user_id' => [
                'nullable',
                Rule::exists('users', 'id'),
            ],
            'name' => ['required_without:user_id'],
            'email' => ['email', 'required_without:user_id'],
            'cro' => ['required', new Cro()],
            'cpf' => ['nullable', new Cpf()],
            'city' => 'required',
            'state' => ['required', Rule::in(config('states')),]
        ];
    }
}