<?php

use Curfle\Support\Str;

return [

    /**
     * Here you may define your custom authentication guards, which can be
     * accessed via the "auth:myGuard" middleware. With these guards you can
     * ensure that only specific users can access your applications' sensible
     * information.
     *
     * The "default" guard will be used, if no other guard is specified - e.g.
     * $route->middleware("auth");
     */
    "guardians" => [
        "default" => [
            "drivers" => [
                \Curfle\Auth\Guardians\Guardian::DRIVER_BEARER
            ],
            "authenticatable" => \App\Models\Benutzer::class,
            "guardian" => \Curfle\Auth\Guardians\JWTGuardian::class
        ]
    ]

];