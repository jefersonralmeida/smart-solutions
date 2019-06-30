<?php

namespace App\Scopes;

use Auth;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class CurrentClinicScope implements Scope
{
    protected $relation;

    public function __construct(?string $relation = null)
    {
        $this->relation = $relation;
    }

    /**
     * Apply the scope to a given Eloquent query builder.
     *
     * @param  \Illuminate\Database\Eloquent\Builder $builder
     * @param  \Illuminate\Database\Eloquent\Model $model
     * @return void
     */
    public function apply(Builder $builder, Model $model)
    {
        if ($this->relation !== null) {
            $builder->whereHas($this->relation, function (Builder $builder) {
                $builder->where('clinic_id', Auth::user()->clinic->id);
            });
            return;
        }
        $builder->where('clinic_id', Auth::user()->clinic->id);
    }
}