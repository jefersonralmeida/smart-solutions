<?php

namespace App\Jobs;

trait Dispatchable
{

    use \Illuminate\Foundation\Bus\Dispatchable {
        dispatch as dispatchQueue;
    }

    public static function dispatch()
    {
        if (config('queue.enabled')) {
            return static::dispatch();
        }
        return static::dispatchNow();
    }
}