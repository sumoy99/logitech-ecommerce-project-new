<?php

namespace App\Providers;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register()
    {
        try {
            // Redis health check
            Cache::store('redis')->put('health_check', 'ok', 1);
        } catch (\Exception $e) {
            // Redis unavailable, fallback to file cache
            Config::set('cache.default', env('FALLBACK_CACHE_DRIVER', 'file'));
    
            // Optional: log it for debugging
            Log::warning('Redis unavailable. Fallback to file cache.');
        }
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}



