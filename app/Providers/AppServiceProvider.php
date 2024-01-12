<?php

namespace App\Providers;

use Illuminate\Support\Facades\Vite;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void {
        //
    }

    public function boot(): void {
        Vite::macro('image', fn(string $asset) => $this->asset("resources/images/{$asset}"));
    }
}
