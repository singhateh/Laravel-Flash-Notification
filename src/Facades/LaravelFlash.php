<?php

namespace Jambasangsang\Flash\Facades;


use Illuminate\Support\Facades\Facade;

class LaravelFlash extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'flash';
    }
}
