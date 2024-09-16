<?php

namespace App\Providers;

use App\Support\Traits\WithTimezoneDisplay;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Vite;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    use WithTimezoneDisplay;

    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Macros
        $this->registerInApplicationTimezone();
        $this->registerInUserTimezone();
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Database
        Model::shouldBeStrict();

        // Assets
        Vite::prefetch(concurrency: 3);
    }
}
