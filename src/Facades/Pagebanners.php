<?php

namespace TypiCMS\Modules\Pagebanners\Facades;

use Illuminate\Support\Facades\Facade;

class Pagebanners extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'Pagebanners';
    }
}
