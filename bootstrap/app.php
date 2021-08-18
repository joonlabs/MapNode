<?php

/**
 * Create the application, that ties the framework together.
 */
$app = new Curfle\Essence\Application(
    $_ENV['APP_BASE_PATH'] ?? dirname(__DIR__)
);

/**
 * Bind the HTTP and Console Kernels to the $app.
 */
$app->singleton(
    Curfle\Agreements\Http\Kernel::class,
    App\Http\Kernel::class
);

$app->singleton(
    Curfle\Agreements\Console\Kernel::class,
    App\Console\Kernel::class
);

/**
 * Return the application.
 */
return $app;