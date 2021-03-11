<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class Money extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'moneymanager';
    }
}
