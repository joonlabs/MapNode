<?php

use App\Models\User;
use Curfle\Http\Request;
use Curfle\Support\Facades\Route;

/**
 * Here the api routes can be registered. All routes in this directory
 * will receive the "api" middleware group. Also, they will get the
 * "/api" prefix. Enjoy building your api!
 */
Route::get('/user/all', function (Request $request) {
    return User::all();
});