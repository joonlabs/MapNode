<?php

namespace App\GraphQL\Queries;

use App\GraphQL\Types\Mandant;
use App\GraphQL\Utilities\Definition;
use Curfle\Http\Request;
use Curfle\Support\Facades\Auth;
use GraphQL\Errors\UnauthenticatedError;
use GraphQL\Fields\GraphQLTypeField;
use GraphQL\Types\GraphQLList;
use GraphQL\Types\GraphQLNonNull;


class MandantenDefinition extends Definition
{

    static ?object $instance = null;

    /**
     * @inheritDoc
     */
    public static function build(): object
    {
        return new GraphQLTypeField(
            "mandanten",
            new GraphQLList(new GraphQLNonNull(Mandant::get())),
            "Gibt alle Mandanten aus",
            function ($_, $args) {
                // validate request
                if(!Auth::validate(Request::capture()))
                    throw new UnauthenticatedError("Missing or invalid token.");

                // return data
                return \App\Models\Mandant::all();
            }
        );
    }
}