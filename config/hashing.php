<?php

return [

    /**
     * Here you may specify the default password hashing driver, which is used
     * for generating and verifying password hashes. Supported algorithms are
     * "bcyrpt", "argon2i" and "argon2id".
     */
    "driver" => "bcrypt",

    /**
     * Here you can change the default options for the BCrypt algorithm.
     * Keep in mind, that changing this configuration will affect factors
     * like computation time needed for generating or verifying passwords.
     */
    "bcrypt" => [
        "rounds" => env("BCRYPT_ROUNDS", 10),
    ],

    /**
     * Here you can change the default options for the Argon algorithm.
     * Keep in mind, that changing this configuration will affect factors
     * like computation time needed for generating or verifying passwords.
     */
    "argon" => [
        "memory" => env("ARGON_MEMORY", 1024),
        "threads" => env("ARGON_THREADS", 2),
        "time" => env("ARGON_TIME", 2),
    ],

];