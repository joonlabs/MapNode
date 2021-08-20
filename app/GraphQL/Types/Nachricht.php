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

class Nachricht extends Definition
{

    static ?object $instance = null;
    /**
     * @inheritDoc
     */
    public static function build(): object
    {
        return new GraphQLObjectType(
            "Nachricht",
            "Eine Kategorie",
            function () {
                return [
                    new GraphQLTypeField(
                        "id",
                        new GraphQLNonNull(new GraphQLInt()),
                    ),
                    new GraphQLTypeField(
                        "eintrag",
                        new GraphQLNonNull(Eintrag::get()),
                    ),
                    new GraphQLTypeField(
                        "buerger",
                        new GraphQLNonNull(Buerger::get()),
                    ),
                    new GraphQLTypeField(
                        "inhalt",
                        new GraphQLNonNull(new GraphQLString()),
                    ),
                    new GraphQLTypeField(
                        "bestaetigt",
                        new GraphQLNonNull(new GraphQLBoolean()),
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