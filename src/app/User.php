<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Notifications\DatabaseNotificationCollection;
use Illuminate\Notifications\Notifiable;

/**
 * Class User
 * @package App
 * @property int $id
 * @property string name
 * @property string email
 * @property string api_token
 * @property int clinic_id
 * @property int dentist_id
 * @property string[] permissions
 * @property Clinic clinic
 * @property DatabaseNotificationCollection|DatabaseNotification[] notifications
 * @property DatabaseNotificationCollection|DatabaseNotification[] unreadNotifications
 * @mixin \Eloquent
 */
class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password'
    ];

    protected $casts = [
        'permissions' => 'array',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function clinic()
    {
        return $this->belongsTo(Clinic::class);
    }


}
