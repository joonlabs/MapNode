<?php

use Curfle\Support\Str;

return [

    /**
     * Here you may specify your default database connection. This one will
     * be used if no other connector name gets specified. Of course, you can
     * use as many (different) connections as you would like to do.
     */
    "default" => env("DB_CONNECTION", "mysql"),

    /**
     * This table keeps track of all the migrations that have already run for
     * your application. Using this information, we can determine which of
     * the migrations on disk haven't actually been run in the database.
     * If the default name "migrations" conflicts with any of your tables,
     * you may want to change it here.
     */
    "migrations" => "migrations",

    /**
     * Here are each of the database connections setup for your application.
     * Of course, examples of configuring each database platform that is
     * supported by Curfle is shown below to make development simple.
     */
    "connections" => [

        "sqlite" => [
            "driver" => "sqlite",
            "database" => env("DB_DATABASE", database_path("database.sqlite")),
            "foreign_key_constraints" => env("DB_FOREIGN_KEYS", true),
        ],

        "mysql" => [
            "driver" => "mysql",
            "host" => env("DB_HOST", "127.0.0.1"),
            "port" => env("DB_PORT", "3306"),
            "database" => env("DB_DATABASE", "curfle"),
            "username" => env("DB_USERNAME", "root"),
            "password" => env("DB_PASSWORD", ""),
            "socket" => env("DB_SOCKET", ""),
            "charset" => "utf8mb4",
        ],
    ],

];