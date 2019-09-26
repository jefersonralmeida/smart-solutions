<?php

namespace App;

use Eloquent;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Clinic
 * @package App
 * @property int id
 * @property string name
 * @property string cnpj
 * @property Collection|Address[] addresses
 * @property Collection|Dentist[] dentists
 * @property Collection|User[] users
 * @property Collection|User[] applicants
 * @mixin Eloquent
 */
class Clinic extends Model
{
    protected $fillable = ['name', 'cnpj'];

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = sanitizeString($value);
    }

    public function setCnpjAttribute($value)
    {
        $this->attributes['cnpj'] = removeMask($value, config('masks.cnpj'));
    }

    public function getCnpjAttribute()
    {
        return !is_null($this->attributes['cnpj']) ? addMask($this->attributes['cnpj'], config('masks.cnpj')) : null;
    }

    public function addresses()
    {
        return $this->hasMany(Address::class);
    }

    public function dentists()
    {
        return $this->hasMany(Dentist::class);
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function applicants()
    {
        return $this->hasMany(User::class, 'applied_clinic_id');
    }
}
