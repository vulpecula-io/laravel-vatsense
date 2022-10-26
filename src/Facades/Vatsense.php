<?php

namespace Vulpecula\Vatsense\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Vulpecula\Vatsense\Vatsense
 */
class Vatsense extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Vulpecula\Vatsense\Vatsense::class;
    }
}
