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

class MandantInput extends Definition
{

    static ?object $instance = null;

    /**
     * @inheritDoc
     */
    public static function build(): object
    {
        return new GraphQLInputObjectType(
            "MandantInput",
            "Ein neuer Mandant",
            function () {
                return [
                    new GraphQLTypeField(
                        "name",
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
                ];
            });
    }
}