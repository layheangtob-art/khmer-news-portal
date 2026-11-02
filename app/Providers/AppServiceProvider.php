<?php

namespace App\Providers;

use Carbon\Carbon;
use Barryvdh\Debugbar\Facades\Debugbar;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;

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
        Paginator::useBootstrapFive();

        // Laravel Cloud overwrites the media disk with S3 config but does not
        // set visibility, so uploaded objects would be private and unreadable.
        if (config('filesystems.disks.media.driver') === 's3') {
            config(['filesystems.disks.media.visibility' => 'public']);
        }
    }
}
