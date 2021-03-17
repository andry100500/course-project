<?php

namespace App\Providers;


use App\Services\CourseManager;
use Illuminate\Support\ServiceProvider;

class CourseManagerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('coursemanager', function ($app) {
            return new CourseManager();
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
