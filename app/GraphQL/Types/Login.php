<?php

namespace App\GraphQL\Types;

use App\GraphQL\Utilities\Definition;
use GraphQL\Fields\GraphQLTypeField;
use GraphQL\Types\GraphQLNonNull;
use GraphQL\Types\GraphQLObjectType;
use GraphQL\Types\GraphQLString;

class Login extends Definition
{

    static ?object $instance = null;
    /**
     * @inheritDoc
     */
    public static function build(): object
    {
        return new GraphQLObjectType(
            "Login",
            "Ein erfolgreicher Login",
            function () {
                return [
                    new GraphQLTypeField(
                        "token",
                        new GraphQLNonNull(new GraphQLString()),
                        "JWT für den eingeloggten Benutzer"
                    ),
                ];
            }
        );
    }
}