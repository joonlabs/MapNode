<?php

namespace App\GraphQL;

use GraphQL\Errors\GraphQLError;
use GraphQL\Types\GraphQLObjectType;
use GraphQL\Schemas\Schema as GraphQLSchema;

class Schema
{
    /**
     * @throws GraphQLError
     */
    public static function get(): GraphQLSchema
    {
        return new GraphQLSchema(
            Query::get(),
            Mutation::get()
        );
    }
}