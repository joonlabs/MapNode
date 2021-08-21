<?php

namespace App\GraphQL;

use App\GraphQL\Queries\EintragDefinition;
use App\GraphQL\Queries\KategorienDefinition;
use App\GraphQL\Queries\MandantDefinition;
use App\GraphQL\Queries\MandantenDefinition;
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
                MandantenDefinition::get(),
                MandantDefinition::get(),
                EintragDefinition::get(),
                KategorienDefinition::get(),
            ];
        });
    }
}