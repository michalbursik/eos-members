<?php

namespace Modules\Member\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as BaseRouteServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends BaseRouteServiceProvider
{
    public function boot(): void
    {
        $this->routes(function () {
           Route::middleware('api')
               ->prefix('api')
               ->group(__DIR__.'/../Http/routes.php');
        });
    }
}
