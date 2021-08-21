<?php

namespace App\GraphQL\Queries;

use App\GraphQL\Types\Kategorie;
use App\GraphQL\Types\Mandant;
use App\GraphQL\Utilities\Definition;
use Curfle\Http\Request;
use Curfle\Support\Facades\Auth;
use GraphQL\Errors\UnauthenticatedError;
use GraphQL\Fields\GraphQLTypeField;
use GraphQL\Types\GraphQLList;
use GraphQL\Types\GraphQLNonNull;


class KategorienDefinition extends Definition
{

    static ?object $instance = null;

    /**
     * @inheritDoc
     */
    public static function build(): object
    {
        return new GraphQLTypeField(
            "kategorien",
            new GraphQLList(new GraphQLNonNull(Kategorie::get())),
            "Gibt alle Kategorien aus",
            function ($_, $args) {
                // return data
                return \App\Models\Kategorie::all();
            }
        );
    }
}