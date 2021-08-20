<?php

namespace App\GraphQL;

use App\GraphQL\Mutations\LoginDefinition;
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
                LoginDefinition::get()
            ];
        });
    }
}