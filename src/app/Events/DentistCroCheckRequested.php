<?php

namespace App\Events;

use App\Dentist;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Queue\SerializesModels;

class DentistCroCheckRequested
{
    use SerializesModels;

    protected $dentist;

    /**
     * Create a new event instance.
     *
     * @return void
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
