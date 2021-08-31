<?php

namespace App\GraphQL\Types;

use App\GraphQL\Utilities\Definition;
use GraphQL\Fields\GraphQLTypeField;
use GraphQL\Types\GraphQLBoolean;
use GraphQL\Types\GraphQLFloat;
use GraphQL\Types\GraphQLInt;
use GraphQL\Types\GraphQLNonNull;
use GraphQL\Types\GraphQLObjectType;
use GraphQL\Types\GraphQLString;

class Config extends Definition
{

    static ?object $instance = null;
    /**
     * @inheritDoc
     */
    public static function build(): object
    {
        return new GraphQLObjectType(
            "Config",
            "Eine Config",
            function () {
                return [
                    new GraphQLTypeField(
                        "adressomat_token",
                        new GraphQLNonNull(new GraphQLString()),
                    ),
                ];
            }
        );
    }
}