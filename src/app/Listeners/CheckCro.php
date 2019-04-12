<?php

namespace App\Listeners;

use App\Events\DentistCreated;
use App\Events\DentistCroCheckRequested;
use App\Events\DentistEventContract;
use App\Events\DentistUpdated;
use App\Jobs\CheckCroJob;
use Auth;
use Illuminate\Events\Dispatcher;

class CheckCro
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function onCreate(DentistCreated $event)
    {
        CheckCroJob::dispatch($event->getDentist(), Auth::user());
    }

    public function onUpdate(DentistUpdated $event)
    {
        $old = $event->getOldDentist();
        $new = $event->getNewDentist();
        // if the CRO or the name changed, check it again
        if ($old->cro !== $new->cro || $old->name !== $new->name) {
            $new->cro_status = "W";
            $new->cro_status_message = "";
            $new->cro_dispatched_at = now();
            $new->save();
            CheckCroJob::dispatch($new, Auth::user());
        }
    }

    public function onCheckRequest(DentistCroCheckRequested $event)
    {
        $dentist = $event->getDentist();
        $dentist->cro_status = "W";
        $dentist->cro_status_message = "";
        $dentist->cro_dispatched_at = now();
        $dentist->save();
        CheckCroJob::dispatch($dentist, Auth::user());
    }

//    /**
//     * Handle the event.
//     *
//     * @param DentistEventContract $event
//     * @return void
//     */
//    public function handle(DentistEventContract $event)
//    {
//        CheckCroJob::dispatch($event->getDentist(), Auth::user());
//    }

    public function subscribe(Dispatcher $dispatcher)
    {
        $dispatcher->listen(DentistCreated::class, static::class . '@onCreate');
        $dispatcher->listen(DentistUpdated::class, static::class . '@onUpdate');
        $dispatcher->listen(DentistCroCheckRequested::class, static::class . '@onCheckRequest');
    }
}
