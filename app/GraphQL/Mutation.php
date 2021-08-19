<?php

namespace App\GraphQL;

use GraphQL\Arguments\GraphQLFieldArgument;
use GraphQL\Fields\GraphQLTypeField;
use GraphQL\Types\GraphQLInt;
use GraphQL\Types\GraphQLNonNull;
use GraphQL\Types\GraphQLObjectType;
use GraphQL\Schemas\Schema as GraphQLSchema;
use GraphQL\Types\GraphQLString;

class Mutation
{
    /**
     * Returns the Root Query Type.
     *
     * @return GraphQLObjectType
     */
    public static function get(): GraphQLObjectType
    {
        return new GraphQLObjectType("Mutation", "Root Mutation", function (){
            return [
                new GraphQLTypeField(
                    "calc",
                    new GraphQLInt(),
                    "Your first calc mutation in GraphQL",
                    function ($_, $args){
                        return $args["a"] + $args["b"];
                    },
                    [
                        new GraphQLFieldArgument("a", new GraphQLNonNull(new GraphQLInt()), "", 2),
                        new GraphQLFieldArgument("b", new GraphQLNonNull(new GraphQLInt()))
                    ]
                )
            ];
        });
    }
}