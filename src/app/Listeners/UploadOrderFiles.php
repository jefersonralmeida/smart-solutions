<?php

namespace App\Listeners;

use App\Events\FileUploaded;
use App\Jobs\UploadFile;
use Illuminate\Events\Dispatcher;

class UploadOrderFiles
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

    /**
     * @param FileUploaded $event
     */
    public function onFileUploaded(FileUploaded $event)
    {

        $destinationPath = config('paths.orders') . '/' . $event->getOrder()->id;

        foreach ($event->getFiles() as $fileName => $fileObject) {

            // save the file on local storage before sending to the queue (so we don't lose the temporary file)
            $localFileLocation = $fileObject->store($destinationPath, 'local');

            // calculate the correct file name to be stored (included the automatic found extension)
            $fileName = preg_replace('/^.+?(\.[A-Za-z0-9]+)$/', "{$fileName}$1", $localFileLocation);
            $fileName = $destinationPath . '/' . $fileName;

            // dispatch the job that uploads the file to the remote storage
            UploadFile::dispatch($localFileLocation, $fileName);
        }
    }

    /**
     * @param Dispatcher $dispatcher
     */
    public function subscribe(Dispatcher $dispatcher)
    {
        $dispatcher->listen(FileUploaded::class, static::class . '@onFileUploaded');
    }
}
