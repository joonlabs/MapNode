<?php

namespace App\GraphQL\Queries;

use App\GraphQL\Types\Config;
use App\GraphQL\Types\Kategorie;
use App\GraphQL\Types\Mandant;
use App\GraphQL\Utilities\Definition;
use Curfle\Http\Request;
use Curfle\Support\Facades\Auth;
use GraphQL\Errors\UnauthenticatedError;
use GraphQL\Fields\GraphQLTypeField;
use GraphQL\Types\GraphQLList;
use GraphQL\Types\GraphQLNonNull;


class ConfigDefinition extends Definition
{

    static ?object $instance = null;

    /**
     * @inheritDoc
     */
    public static function build(): object
    {
        return new GraphQLTypeField(
            "config",
            new GraphQLNonNull(Config::get()),
            "Gibt die Config aus",
            function ($_, $args) {
                // return data
                return [
                    "adressomat_token" => env("ADRESSOMAT_TOKEN")
                ];
            }
        );
    }
}