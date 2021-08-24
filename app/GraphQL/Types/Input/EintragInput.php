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

class EintragInput extends Definition
{

    static ?object $instance = null;

    /**
     * @inheritDoc
     */
    public static function build(): object
    {
        return new GraphQLInputObjectType(
            "EintragInput",
            "Ein neuer Karteneintrag",
            function () {
                return [
                    new GraphQLTypeField(
                        "name",
                        new GraphQLNonNull(new GraphQLString()),
                    ),
                    new GraphQLTypeField(
                        "status",
                        new GraphQLInt(),
                    ),
                    new GraphQLTypeField(
                        "inhalt",
                        new GraphQLString(),
                    ),
                    new GraphQLTypeField(
                        "latitude",
                        new GraphQLNonNull(new GraphQLFloat()),
                    ),
                    new GraphQLTypeField(
                        "longitude",
                        new GraphQLNonNull(new GraphQLFloat()),
                    ),
                    new GraphQLTypeField(
                        "mandant_id",
                        new GraphQLNonNull(new GraphQLInt()),
                    ),
                    new GraphQLTypeField(
                        "kategorie_id",
                        new GraphQLNonNull(new GraphQLInt()),
                    ),
                    new GraphQLTypeField(
                        "buerger_id",
                        new GraphQLNonNull(new GraphQLInt()),
                    ),
                    new GraphQLTypeField(
                        "bestaetigt",
                        new GraphQLBoolean(),
                    ),
                    new GraphQLTypeField(
                        "chat_verfuegbar",
                        new GraphQLBoolean(),
                    ),
                    new GraphQLTypeField(
                        "nachricht_bei_interaktion",
                        new GraphQLBoolean(),
                    ),
                ];
            });
    }
}