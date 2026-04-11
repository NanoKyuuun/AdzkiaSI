<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;


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
        Blade::component('layout.landing', 'landing');   
        Blade::component('layout.guest', 'guest');   
        Blade::component('layout.app', 'app');   
        Blade::component('layouts.auth', 'layouts.auth');   
    }
}
