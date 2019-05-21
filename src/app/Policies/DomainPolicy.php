<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class DomainPolicy
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

    public function aligner()
    {
        return request()->getHost() === config('domains.alignerDomain');
    }

    public function solutions()
    {
        return request()->getHost() === config('domains.solutionsDomain');
    }

}
