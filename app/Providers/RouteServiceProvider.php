<?php


namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Route::middleware('role', \App\Http\Middleware\CheckRole::class);
        parent::boot();
    }
}
