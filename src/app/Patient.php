<?php

namespace App;

use App\Scopes\CurrentClinicScope;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Patient
 * @package App
 * @mixin \Eloquent
 * @property int id
 * @property string name
 * @property Carbon birthday
 * @property string email
 * @property string phone
 * @property string city
 * @property string state
 * @property string gender
 * @property string cellphone
 * @property int clinic_id
 * @property Clinic clinic
 * @property Carbon created_at
 * @property Carbon updated_at
 * @method static Patient onlyTrashed()
 */
class Patient extends Model
{

    use SoftDeletes;

    protected $fillable = ['name', 'birthday', 'email', 'phone', 'city', 'state', 'gender', 'cellphone'];

    protected $dates = ['birthday'];

    /**
     * @see CurrentClinicScope
     */
    protected static function boot()
    {
        parent::boot();

        // apply current clinic scope
        static::addGlobalScope(new CurrentClinicScope());
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
