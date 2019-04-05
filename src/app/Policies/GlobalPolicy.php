<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class GlobalPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function clinicAdmin(User $user)
    {
        return $user->clinic_id !== null && array_search('clinic-admin', $user->permissions) !== false;
    }

    public function dashboard(User $user)
    {
        return $user->clinic_id !== null;
    }

    public function orders(User $user)
    {
        return $user->clinic_id !== null;
    }

    public function order(User $user)
    {
        return $user->clinic_id !== null;
    }

    public function patients(User $user)
    {
        return $user->clinic_id !== null;
    }

    public function dentists(User $user)
    {
        return $user->clinic_id !== null;
    }





}
