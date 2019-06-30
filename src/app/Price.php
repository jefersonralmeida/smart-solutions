<?php

namespace App;

use App\Scopes\CurrentClinicScope;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Address
 * @package App
 * @mixin \Eloquent
 * @property int product_id
 * @property array prices
 */
class Price extends Model
{
    protected $casts = [
        'prices' => 'array',
    ];
}
