<?php

namespace App\Providers;

use Carbon\Carbon;
use Barryvdh\Debugbar\Facades\Debugbar;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Carbon::setLocale('km');
        if (class_exists(\Barryvdh\Debugbar\Facades\Debugbar::class)) {
            Debugbar::disable();
        }
    }
}
