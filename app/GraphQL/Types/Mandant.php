<?php

namespace App\GraphQL\Types;

use App\GraphQL\Utilities\Definition;
use GraphQL\Fields\GraphQLTypeField;
use GraphQL\Types\GraphQLBoolean;
use GraphQL\Types\GraphQLFloat;
use GraphQL\Types\GraphQLInt;
use GraphQL\Types\GraphQLList;
use GraphQL\Types\GraphQLNonNull;
use GraphQL\Types\GraphQLObjectType;
use GraphQL\Types\GraphQLString;

class Mandant extends Definition
{

    static ?object $instance = null;

    /**
     * @inheritDoc
     */
    public static function build(): object
    {
        return new GraphQLObjectType(
            "Mandant",
            "Ein Mandant",
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
                        "kennung",
                        new GraphQLNonNull(new GraphQLString()),
                    ),
                    new GraphQLTypeField(
                        "karte_latitude",
                        new GraphQLNonNull(new GraphQLFloat()),
                    ),
                    new GraphQLTypeField(
                        "karte_longitude",
                        new GraphQLNonNull(new GraphQLFloat()),
                    ),
                    new GraphQLTypeField(
                        "karte_zoom",
                        new GraphQLNonNull(new GraphQLInt()),
                    ),
                    new GraphQLTypeField(
                        "eintraege",
                        new GraphQLList(new GraphQLNonNull(Eintrag::get())),
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