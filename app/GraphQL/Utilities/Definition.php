<?php

namespace App\GraphQL\Utilities;

abstract class Definition
{
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
        if (static::$instance !== null)
            return static::$instance;

        return static::$instance = static::build();
    }
}