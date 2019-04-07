<?php

namespace App\Rules;

use DB;
use Illuminate\Contracts\Validation\Rule;

class UniqueSoftDeletes implements Rule
{
    protected $table;
    protected $column;
    protected $ignore = null;
    protected $extraConditions = [];
    protected $restoreRoute;
    protected $message = "O :attribute já foi utilizado.";

    /**
     * Create a new rule instance.
     *
     * @param string $table
     * @param string $column
     * @param string $ignore
     * @param array $extraConditions
     */
    public function __construct(string $table, string $column, string $restoreRoute, ?string $ignore = null, array $extraConditions = [])
    {
        $this->table = $table;
        $this->column = $column;
        $this->restoreRoute = $restoreRoute;
        $this->ignore = $ignore;
        $this->extraConditions = $extraConditions;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $query = DB::table($this->table);
        $query->where($this->column, $value);
        if ($this->ignore !== null) {
            $query->where('id', '<>', $this->ignore);
        }

        $row = $query->first();

        if ($row === null) {
            return true;
        }

        if ($row->deleted_at !== null) {
            $restoreUrl = route($this->restoreRoute, [$row->id]);
            $this->message = "O :attribute pertence a um item deletado. Deseja <a href=\"$restoreUrl\">restaurar</a>?";
        }

        return false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return $this->message;
    }
}
