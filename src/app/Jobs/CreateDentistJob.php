<?php

namespace App\Jobs;

use App\Dentist;
use App\ExternalApi\Orders\OrdersApiContract;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class CreateDentistJob implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels, Dispatchable;

    public $timeout = 10;
    public $tries = 5;

    /**
     * @var Dentist
     */
    protected $dentist;

    /**
     * @var User
     */
    protected $creator;

    /**
     * Create a new job instance.
     *
     * @param Dentist $dentist
     * @param User $creator
     */
    public function __construct(Dentist $dentist, User $creator)
    {
        $this->dentist = $dentist;
        $this->creator = $creator;
    }

    /**
     * Execute the job.
     *
     * @param OrdersApiContract $api
     * @return void
     */
    public function handle(OrdersApiContract $api)
    {
        $response = $api->createDentist($this->dentist);

        $this->dentist->integration_status = 'success';
        $this->dentist->integration_id = $response->getId();

        $this->dentist->save();
    }
}
