<?php

namespace App\Providers;

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
        // Paksa jalur cache tampilan (compiled views) ke direktori storage internal
        config(['view.compiled' => base_path('storage/framework/views')]);

        // Otomatis buat direktori jika kontainer Docker kehilangan foldernya
        if (!is_dir(config('view.compiled'))) {
            @mkdir(config('view.compiled'), 0775, true);
        }
    }
}