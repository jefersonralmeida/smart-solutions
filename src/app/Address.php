<?php

namespace App;

use App\Scopes\CurrentClinicScope;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Address
 * @package App
 * @mixin \Eloquent
 * @property int id
 * @property string identification
 * @property string receiver_name
 * @property string zip_code
 * @property string street
 * @property string street_number
 * @property string address_details
 * @property string district
 * @property string city
 * @property string state
 * @property string reference_point
 * @property string phone
 * @property int clinic_id
 * @property array integration
 * @property Clinic $clinic
 */
class Address extends Model
{
    protected static function boot()
    {
        parent::boot();

        // apply current clinic scope
        static::addGlobalScope(new CurrentClinicScope());
    }

    protected $casts = [
        'integration' => 'array',
    ];

    public function clinic()
    {
        return $this->belongsTo(Clinic::class);
    }
}
