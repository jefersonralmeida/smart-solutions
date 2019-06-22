<?php

namespace App\Jobs;

trait Dispatchable
{

    use \Illuminate\Foundation\Bus\Dispatchable {
        dispatch as dispatchQueue;
    }

    public static function dispatch(...$params)
    {
        if (config('queue.enabled')) {
            return static::dispatchQueue(...$params);
        }
        return static::dispatchNow(...$params);
    }
}