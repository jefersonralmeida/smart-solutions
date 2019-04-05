<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Address
 * @package App
 * @property string identification
 * @property string receiver_name
 * @property string street_address_1
 * @property string street_address_2
 * @property string reference_point
 * @property string phone
 * @property int clinic_id
 * @property Clinic $clinic
 */
class Address extends Model
{
    public function clinic()
    {
        return $this->belongsTo(Clinic::class);
    }
}
