<?php

namespace App\GraphQL;

use App\GraphQL\Mutations\BearbeiteEintragDefinition;
use App\GraphQL\Mutations\BearbeiteMandantDefinition;
use App\GraphQL\Mutations\ErstelleBuergerDefinition;
use App\GraphQL\Mutations\ErstelleEintragDefinition;
use App\GraphQL\Mutations\ErstelleMandantDefinition;
use App\GraphQL\Mutations\ErstelleNachrichtDefinition;
use App\GraphQL\Mutations\LoginDefinition;
use App\GraphQL\Mutations\UpvoteEintragDefinition;
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
                LoginDefinition::get(),
                ErstelleEintragDefinition::get(),
                ErstelleBuergerDefinition::get(),
                ErstelleNachrichtDefinition::get(),
                ErstelleMandantDefinition::get(),
                BearbeiteEintragDefinition::get(),
                UpvoteEintragDefinition::get(),
                BearbeiteMandantDefinition::get(),
            ];
        });
    }
}