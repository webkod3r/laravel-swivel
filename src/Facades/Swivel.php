<?php

namespace LaravelSwivel\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static \LaravelSwivel\SwivelLoader getLoader()
 * @method static \Zumba\Swivel\Builder forFeature()
 * @method static mixed invoke()
 * @method static mixed returnValue()
 */
class Swivel extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'swivel';
    }
}
