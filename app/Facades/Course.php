<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class Course extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'coursemanager';
    }
}
