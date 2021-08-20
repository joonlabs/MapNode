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

class Buerger extends Definition
{

    static ?object $instance = null;
    /**
     * @inheritDoc
     */
    public static function build(): object
    {
        return new GraphQLObjectType(
            "Buerger",
            "Ein Buerger",
            function () {
                return [
                    new GraphQLTypeField(
                        "id",
                        new GraphQLNonNull(new GraphQLInt()),
                    ),
                    new GraphQLTypeField(
                        "vorname",
                        new GraphQLNonNull(new GraphQLString()),
                    ),
                    new GraphQLTypeField(
                        "nachname",
                        new GraphQLNonNull(new GraphQLString()),
                    ),
                    new GraphQLTypeField(
                        "email",
                        new GraphQLNonNull(new GraphQLString()),
                    ),
                    new GraphQLTypeField(
                        "strasse",
                        new GraphQLString(),
                    ),
                    new GraphQLTypeField(
                        "hausnummer",
                        new GraphQLString(),
                    ),
                    new GraphQLTypeField(
                        "stadt",
                        new GraphQLString(),
                    ),
                    new GraphQLTypeField(
                        "plz",
                        new GraphQLInt(),
                    ),
                    new GraphQLTypeField(
                        "telefon",
                        new GraphQLString(),
                    ),
                    new GraphQLTypeField(
                        "erstellt",
                        new GraphQLNonNull(new GraphQLString()),
                    ),
                ];
            }
        );
    }
}