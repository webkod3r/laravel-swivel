<?php

namespace Webkod3r\LaravelSwivel\Support\Facades;

use Illuminate\Support\Facades\Facade;

class Swivel extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'Swivel';
    }
}
