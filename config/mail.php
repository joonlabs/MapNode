<?php

return [

    /**
     * This option controls the default mailer that is used to send any email
     * messages sent by your application. Supported mailers are "smtp".
     */
    "default" => env("MAIL_MAILER", "smtp"),

    /**
     * Here you may configure all the mailers used by your application plus
     * their respective settings.
     */
    "mailers" => [
        "smtp" => [
            "host" => env("MAIL_HOST", "smtp.curfle.org"),
            "port" => env("MAIL_PORT", 465),
            "encryption" => env("MAIL_ENCRYPTION", "tls"),
            "username" => env("MAIL_USERNAME"),
            "password" => env("MAIL_PASSWORD"),
        ],
    ],

    /**
     * Here you may configure the default mail address and name of the
     * mails' sender. However, you can still change it manually with every
     * mail that is being sent.
     */
    "from" => [
        "address" => env("MAIL_FROM_ADDRESS", "noreply@curfle"),
        "name" => env("MAIL_FROM_NAME", "Curfle"),
    ],

];