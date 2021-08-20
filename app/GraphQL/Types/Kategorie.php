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

class Kategorie extends Definition
{

    static ?object $instance = null;
    /**
     * @inheritDoc
     */
    public static function build(): object
    {
        return new GraphQLObjectType(
            "Kategorie",
            "Eine Kategorie",
            function () {
                return [
                    new GraphQLTypeField(
                        "id",
                        new GraphQLNonNull(new GraphQLInt()),
                    ),
                    new GraphQLTypeField(
                        "name",
                        new GraphQLNonNull(new GraphQLString()),
                    ),
                    new GraphQLTypeField(
                        "farbe",
                        new GraphQLNonNull(new GraphQLString()),
                    ),
                ];
            }
        );
    }
}