<?php

namespace App\Events;

use App\Dentist;
use Illuminate\Queue\SerializesModels;

class DentistCreated
{
    use SerializesModels;

    /**
     * @var Dentist
     */
    protected $dentist;

    /**
     * Create a new event instance.
     *
     * @param Dentist $dentist
     */
    public function __construct(Dentist $dentist)
    {
        $this->dentist = $dentist;
    }

    public function getDentist(): Dentist
    {
        return $this->dentist;
    }
}
