<?php

use Curfle\Support\Facades\Route;

/**
 * Here the default web routes can be registered. All routes in this directory get
 * will receive the web middleware stack. Now start creating something awesome!
 */

Route::get('/', function () {
    return "hello world!";
});