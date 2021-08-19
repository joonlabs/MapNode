<?php

namespace App\GraphQL;

use GraphQL\Fields\GraphQLTypeField;
use GraphQL\Types\GraphQLObjectType;
use GraphQL\Schemas\Schema as GraphQLSchema;
use GraphQL\Types\GraphQLString;

class Query
{
    /**
     * Returns the Root Query Type.
     *
     * @return GraphQLObjectType
     */
    public static function get(): GraphQLObjectType
    {
        return new GraphQLObjectType("Query", "Root Query", function (){
            return [
                new GraphQLTypeField(
                    "hello",
                    new GraphQLString(),
                    "Your first hello world GraphQL-Application",
                    function (){ return 'Hello world!'; }
                )
            ];
        });
    }
}