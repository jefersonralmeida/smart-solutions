<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Http\File;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Storage;

class UploadFile implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $timeout = 15;
    public $tries = 5;

    /**
     * @var string
     */
    protected $fileName;


    /**
     * @var string
     */
    protected $localFileLocation;

    /**
     * Create a new job instance.
     *
     * @param string $localFileLocation
     * @param string $fileName
     */
    public function __construct(string $localFileLocation, string $fileName)
    {
        $this->fileName = $fileName;
        $this->localFileLocation = $localFileLocation;
    }

    /**
     * Execute the job.
     *
     * @return void
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function handle()
    {
        // copy the file from local storage to remote (default) storage
        Storage::writeStream($this->fileName, Storage::disk('local')->readStream($this->localFileLocation));

        // remove the file from local storage
        Storage::disk('local')->delete($this->localFileLocation);

        // remove the empty directories from local storage
        $directory = preg_replace('/\/?[^\/]+$/', '', $this->localFileLocation);
        if (empty(Storage::disk('local')->files($directory))) {
            Storage::disk('local')->deleteDir($directory);
        }
    }
}
