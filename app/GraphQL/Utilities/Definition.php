<?php

namespace App\GraphQL\Utilities;

abstract class Definition
{
    /**
     * Holds the GraphQL-Field, -Argument, -Type, etc. instance.
     *
     * @var object|null
     */
    static ?object $instance = null;

    /**
     * Builds a GraphQL-Field, -Argument, -Type, etc.
     *
     * @return object
     */
    abstract protected static function build(): object;

    /**
     * Returns the builded GraphQL-Field, -Argument, -Type, etc.
     * @return object
     */
    public static function get(): object
    {
        if (self::$instance !== null)
            return self::$instance;

        return self::$instance = call_user_func(get_called_class() . "::build");
    }
}