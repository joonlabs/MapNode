<?php

namespace App\GraphQL\Types\Input;

use App\GraphQL\Types\Buerger;
use App\GraphQL\Types\Kategorie;
use App\GraphQL\Types\Nachricht;
use App\GraphQL\Utilities\Definition;
use GraphQL\Fields\GraphQLTypeField;
use GraphQL\Types\GraphQLBoolean;
use GraphQL\Types\GraphQLFloat;
use GraphQL\Types\GraphQLInputObjectType;
use GraphQL\Types\GraphQLInt;
use GraphQL\Types\GraphQLList;
use GraphQL\Types\GraphQLNonNull;
use GraphQL\Types\GraphQLObjectType;
use GraphQL\Types\GraphQLString;

class BuergerInput extends Definition
{

    static ?object $instance = null;

    /**
     * @inheritDoc
     */
    public static function build(): object
    {
        return new GraphQLInputObjectType(
            "BuergerInput",
            "Ein neuer Bürger",
            function () {
                return [
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
                ];
            });
    }
}