<?php

namespace App\Providers;

use App\Repositories\BookingRepository;
use App\Repositories\ScheduleRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
	    $this->app->bind('BookingRepository', function () {
		    return new BookingRepository();
	    });
	    $this->app->bind('ScheduleRepository', function () {
		    return new ScheduleRepository();
	    });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
