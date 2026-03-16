<?php

namespace App\Providers;

use App\Models\LoanItem;
use App\Observers\LoanItemObserver;
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
        LoanItem::observe(LoanItemObserver::class);
    }
}
