<?php

namespace App\Providers;

use App\Services\MoneyManager;
use Illuminate\Support\ServiceProvider;

class MoneyManagerServiceProvider extends ServiceProvider
{
    public function register()
    {

        // реализация по примеру с официальной документации - не работает

//        $this->app->bind(MoneyManager::class, function ($app) {
//            return new MoneyManager(config('moneymanager'));
//        });


        // Или другая реализация, предоставленная преподавателем:

        $this->app->bind('moneymanager', function ($app) {
            return new MoneyManager();
        });

    }

    public function boot()
    {
        //
    }
}
