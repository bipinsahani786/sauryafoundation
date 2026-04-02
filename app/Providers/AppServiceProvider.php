<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\HomeSector;

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
        View::composer('components.frontend.layout', function ($view) {
            $view->with('navSectors', HomeSector::where('is_active', true)
                ->whereNotNull('slug')
                ->where('slug', '!=', '')
                ->orderBy('order')
                ->get());
        });
    }
}
