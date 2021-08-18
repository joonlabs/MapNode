<?php

use Curfle\Agreements\Http\Kernel;
use Curfle\Http\Request;

define('CURFLE_START', microtime(true));

/**
 * Register the composer autoloader.
 *
 */
require __DIR__.'/../vendor/autoload.php';

/**
 * Load the central application instance from the bootstrap folder.
 *
 */
$app = require_once __DIR__.'/../bootstrap/app.php';

/**
 * Create the HTTP kernel and handle the request
 */
$kernel = $app->make(Kernel::class);
$kernel->handle(
    $request = Request::capture()
)->send();