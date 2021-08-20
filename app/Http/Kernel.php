<?php

namespace App\Http;

use Curfle\Auth\Middleware\Authenticate;
use \Curfle\Essence\Http\Kernel as HttpKernel;
use Curfle\Http\Middleware\AllowCors;
use Curfle\Http\Middleware\TrimStrings;

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * These middlewares are run during every request.
     *
     * @var array
     */
    protected array $middleware = [
        TrimStrings::class
    ];


    /**
     * The application's route middleware groups.
     *
     * @var array
     */
    protected array $middlewareGroups = [
        "web" => [],
        "api" => [
            AllowCors::class
        ],
    ];

    /**
     * The application's route middleware.
     *
     * These middlewares may be assigned to middleware groups or used individually.
     *
     * @var array
     */
    protected array $routeMiddleware = [
        "auth" => Authenticate::class
    ];
}