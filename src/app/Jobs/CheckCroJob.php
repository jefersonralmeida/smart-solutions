<?php

namespace App\Jobs;

use App\Dentist;
use App\ExternalApi\Cro\CroApiContract;
use App\Notifications\CroCheck;
use App\User;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class CheckCroJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $timeout = 15;
    public $tries = 5;

    /**
     * @var User
     */
    protected $creator;

    /**
     * @var Dentist
     */
    protected $dentist;

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
     * @param CroApiContract $api
     * @return void
     * @throws Exception
     */
    public function handle(CroApiContract $api)
    {

        $apiResponse = $api->request($this->dentist->cro);

        if (!$apiResponse) {
            throw new Exception('Serviço de checagem de CRO indisponível.');
        }

        if (!$apiResponse->isActive()) {
            $this->dentist->cro_status = 'R';
            $this->dentist->cro_status_message = 'CRO inativo.';
        } elseif (sanitizeString($apiResponse->getName()) !== sanitizeString($this->dentist->name)) {
            $this->dentist->cro_status = 'R';
            $this->dentist->cro_status_message = 'O nome registrado no CRO não confere com o nome do cadastro.';
        } else {
            $this->dentist->cro_status = 'A';
            $this->dentist->cro_approved_at = now();
        }

        $this->dentist->save();

        $this->creator->notify(new CroCheck($this->dentist));
    }

    /**
     * @param Exception $e
     */
    public function failed(Exception $e)
    {
        $this->dentist->cro_status = 'E';
        $this->dentist->cro_status_message = $e->getMessage();
        $this->dentist->save();

        $this->creator->notify(new CroCheck($this->dentist));
    }
}
