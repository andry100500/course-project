<?php

namespace App\Providers;

use App\Services\MoneyManager;
use Illuminate\Support\ServiceProvider;

class MoneyManagerServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind('moneymanager', function ($app) {
            return new MoneyManager();
        });
    }

    public function boot()
    {
        //
    }
}
