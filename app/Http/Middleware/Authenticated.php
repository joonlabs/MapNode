<?php

namespace App\Http\Middleware;

use Curfle\Console\Application;
use Curfle\Http\Middleware;
use Curfle\Http\Request;
use Curfle\Http\Response;
use Curfle\Support\Exceptions\Http\HttpDispatchableException;

class Authenticated extends Middleware
{
    /**
     * @throws HttpDispatchableException
     */
    public static function handle(Request $request, Response $response)
    {
        if (!$request->hasHeader("Authorization")
            || $request->header("Authorization") !== "YOUR_SECRET_TOKEN") {
            abort(403, "Access denied");
        }
    }
}