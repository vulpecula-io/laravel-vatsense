<?php

namespace Vulpecula\LaravelVatsense\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Vulpecula\LaravelVatsense\LaravelVatsense
 */
class LaravelVatsense extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Vulpecula\LaravelVatsense\LaravelVatsense::class;
    }
}
