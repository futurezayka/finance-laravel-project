<?php

namespace App\Providers;

use App\Models\Transaction;
use App\Services\AccountService;
use App\Services\RateService;
use App\Services\TransactionService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(RateService::class, function ($app){
            return new RateService();
        });

        $this->app->bind(TransactionService::class, function ($app){
            return new TransactionService();
        });

        $this->app->bind(AccountService::class, function ($app){
            return new AccountService();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
