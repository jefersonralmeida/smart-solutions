<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Dentist
 * @package App
 * @mixin \Eloquent
 * @property int id
 * @property string name
 * @property string email
 * @property string cpf
 * @property string cro
 * @property string cro_status - CRO status. 1 char, among: Waiting, Approved, Reproved, Error
 * @property string cro_status_message
 * @property Carbon cro_dispatched_at
 * @property Carbon cro_approved_at
 * @property string city
 * @property string state
 * @property string phone
 * @property string cellphone
 * @property int clinic_id
 * @property Clinic clinic
 * @property User user
 * @property Carbon created_at
 * @property Carbon updated_at
 */
class Dentist extends Model
{

    use SoftDeletes;

    protected $fillable = ['name', 'email', 'cpf', 'cro', 'city', 'state', 'phone', 'cellphone'];

    protected $dates = ['cro_dispatched_at', 'cro_approved_at'];

    public function user()
    {
        return $this->hasOne(User::class);
    }

    /**
     * Sanitizing the name
     * @param $value
     */
    public function setNameAttribute($value)
    {
        if ($value !== null) {
            $this->attributes['name'] = sanitizeString($value);
        }
    }

    public function getNameAttribute()
    {
        return $this->attributes['name'] ?? $this->user->name;
    }

    public function getEmailAttribute()
    {
        return $this->attributes['email'] ?? $this->user->email;
    }

    /**
     * Removing the dashes on CRO
     * @param $value
     */
    public function setCroAttribute($value)
    {
        $this->attributes['cro'] = strtoupper(str_replace('-', '', $value));
    }

    /**
     * Putting the dashes on CRO
     * @return string
     */
    public function getCroAttribute()
    {
        $cro = $this->attributes['cro'];
        preg_match('/^([A-Z]{2})([A-Z]+)(\d+)$/', $cro, $matches);
        return "$matches[1]-$matches[2]-$matches[3]";

    }

    /**
     * Including the mask on CPF
     * @return string
     */
    public function getCpfAttribute()
    {
        return $this->attributes['cpf'] !== null
            ? addMask($this->attributes['cpf'], config('masks.cpf'))
            : $this->attributes['cpf'];
    }

    /**
     * Removing the mask fom CPF
     * @param $value
     */
    public function setCpfAttribute($value)
    {
        if ($value){
            $this->attributes['cpf'] = removeMask($value, config('masks.cpf'));
        }
    }


    public function getPhoneAttribute()
    {
        return $this->attributes['phone']
            ? addMask($this->attributes['phone'], config('masks.phone'))
            : $this->attributes['phone'];
    }

    public function setPhoneAttribute($value)
    {
        if ($value) {
            $this->attributes['phone'] = removeMask($value, config('masks.phone'));
        }
    }

    public function getCellphoneAttribute()
    {
        return $this->attributes['cellphone']
            ? addMask($this->attributes['cellphone'], config('masks.cellphone'))
            : $this->attributes['cellphone'];
    }

    public function setCellphoneAttribute($value)
    {
        if ($value) {
            $this->attributes['cellphone'] = removeMask($value, config('masks.cellphone'));
        }
    }

    public function setCityAttribute($value)
    {
        $this->attributes['city'] = sanitizeString($value);
    }

    public function clinic()
    {
        return $this->belongsTo(Clinic::class);
    }
}
