<?php

use Curfle\Http\Request;
use Curfle\Support\Facades\Route;

/**
 * Here the api routes can be registered. All routes in this directory
 * will receive the "api" middleware group. Also, they will get the
 * "/api" prefix. Enjoy building your api!
 */
Route::methods([Route::POST, Route::OPTIONS], '/', function (Request $request) {
    $server = new \GraphQL\Servers\Server(\App\GraphQL\Schema::get());
    $server->setInternalServerErrorPrint(config("app.debug"));
    return $server->handle();
});