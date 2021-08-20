<?php

namespace App\GraphQL\Queries;

use App\GraphQL\Types\Mandant;
use App\GraphQL\Utilities\Definition;
use Curfle\Http\Request;
use Curfle\Support\Facades\Auth;
use GraphQL\Arguments\GraphQLFieldArgument;
use GraphQL\Errors\UnauthenticatedError;
use GraphQL\Fields\GraphQLTypeField;
use GraphQL\Types\GraphQLInt;
use GraphQL\Types\GraphQLList;
use GraphQL\Types\GraphQLNonNull;


class MandantDefinition extends Definition
{

    static ?object $instance = null;

    /**
     * @inheritDoc
     */
    public static function build(): object
    {
        return new GraphQLTypeField(
            "mandant",
            Mandant::get(),
            "Gibt einen Mandanten aus",
            function ($_, $args) {
                // return data
                return \App\Models\Mandant::get($args["id"]);
            },
            [
                new GraphQLFieldArgument("id", new GraphQLNonNull(new GraphQLInt()))
            ]
        );
    }
}