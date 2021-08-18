<?php

namespace App\Providers;

use Curfle\Essence\Support\Providers\RouteServiceProvider as ServiceProvider;
use Curfle\Http\Request;
use Curfle\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot() 
    {
        $this->routes(function() {
            // register api routes
            Route::middleware("api")
                ->prefix("/api")
                ->group(function(){
                    // add the routes from the api.php file
                    Route::registerRouteFile(base_path('routes/api.php'));
                 });

            // register web routes
            Route::middleware("web")
                ->group(function(){
                    // add the routes from the api.php file
                    Route::registerRouteFile(base_path('routes/web.php'));
                });
        });
    }
}