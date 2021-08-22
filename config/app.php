<?php

return [

    /**
     * The applications' name. It can be used by packages or
     * internal services when an application identifier is needed.
     */
    "name" => env("APP_NAME", "Curfle"),

    /**
     * The environment the app is currently running in. This
     * could be eg. production or local.
     */
    "env" => env("APP_ENV", "production"),

    /**
     * Determines if the app should display detailed error messages
     * with stack traces, file names, tables, etc. or just return a
     * generalized and generic error message.
     */
    "debug" => (bool) env("APP_DEBUG", false),

    /**
     * The applications' url which is needed for correctly generating
     * urls - e.g. from the boddy commandline tool.
     */
    "url" => env("APP_URL", "http://localhost"),

    /**
     * The applications' encryption key. This is used for signing or encrypting
     * data like JWTs. It is highly recommended to no set this in the config file,
     * but using the environemt variable instead, as the secret should not be shared
     * over version control systems.
     */
    "key" => env("APP_KEY"),

    /**
     * The service providers listed here will be automatically loaded on the
     * request to your application. Feel free to add your own services to
     * this array to grant expanded functionality to your applications.
     */
    "providers" => [

        /*
         * Curfle Framework Service Providers...
         */
        Curfle\FileSystem\FileSystemServiceProvider::class,
        Curfle\Essence\Providers\EssenceServiceProvider::class,
        Curfle\Essence\Providers\ConsoleSupportServiceProvider::class,
        Curfle\Database\DatabaseServiceProvider::class,
        Curfle\Mail\MailServiceProvider::class,
        Curfle\Hash\HashServiceProvider::class,
        Curfle\Auth\AuthenticationServiceProvider::class,
        Curfle\View\ViewServiceProvider::class,

        /*
         * Package Service Providers...
         */

        /*
         * Application Service Providers...
         */
        App\Providers\AppServiceProvider::class,
        App\Providers\RouteServiceProvider::class,

    ],

    /**
     * This array of class aliases will be registered when this application
     * is started. However, feel free to register as many as you wish as
     * the aliases are "lazy" loaded, so they don"t hinder performance.
     */
    "aliases" => [
        "App" => Curfle\Support\Facades\App::class,
        "Arr" => Curfle\Support\Arr::class,
        "Config" => Curfle\Support\Facades\Config::class,
        "DB" => Curfle\Support\Facades\DB::class,
        "File" => Curfle\Support\Facades\File::class,
        "Request" => Curfle\Support\Facades\Request::class,
        "Response" => Curfle\Support\Facades\Response::class,
        "Route" => Curfle\Support\Facades\Route::class,
        "Str" => Curfle\Support\Str::class,
    ],

];