<?php

namespace App\Events;

use App\Dentist;
use Illuminate\Queue\SerializesModels;

class DentistUpdated
{
    use SerializesModels;

    protected $oldDentist;

    protected $newDentist;

    /**
     * Create a new event instance.
     *
     * @param Dentist $oldDentist
     * @param Dentist $newDentist
     */
    public function __construct(Dentist $oldDentist, Dentist $newDentist)
    {
        $this->oldDentist = $oldDentist;
        $this->newDentist = $newDentist;
    }

    public function getNewDentist()
    {
        return $this->newDentist;
    }

    public function getOldDentist()
    {
        return $this->oldDentist;
    }

}
