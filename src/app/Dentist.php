<?php

namespace App;

use App\Scopes\CurrentClinicScope;
use App\Scopes\DomainScope;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
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
 * @property string cro_status - [W]aiting, [A]pproved, [R]eproved, [E]rror
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
 * @property string integration_status - [P]rocessing, [F]ailed or [S]uccess
 * @property string integration_id
 * @property Carbon last_order_check
 * @property Carbon created_at
 * @property Carbon updated_at
 * @property Order[]|Collection orders
 * @method static Builder withPendingOrders()
 * @method static Builder approved()
 */
class Dentist extends Model
{

    use SoftDeletes;

    protected $fillable = ['name', 'email', 'cpf', 'cro', 'city', 'state', 'phone', 'cellphone'];

    protected $dates = ['last_order_check', 'cro_dispatched_at', 'cro_approved_at'];

    /**
     * @see CurrentClinicScope
     */
    protected static function boot()
    {
        parent::boot();

        // apply current clinic scope
        static::addGlobalScope(new CurrentClinicScope());
    }

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
        preg_match('/^([A-Z]{2})(\d+)$/', $cro, $matches);
        return "$matches[1]-$matches[2]";

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
        if ($value) {
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

    public function orders()
    {
        return $this->hasMany(Order::class)->withoutGlobalScope(DomainScope::class);
    }

    public function scopeWithPendingOrders(Builder $query)
    {
        $query->whereIn('id', function(\Illuminate\Database\Query\Builder $query) {
            $query->select('dentist_id')
                ->from(with(new Order())->getTable())
                ->where('status', config('orderCheck.pendingStatus'));
            return $query;
        });
        return $query;
    }

    public function scopeApproved(Builder $query)
    {
        return $query->where('cro_status', 'A');
    }
}
