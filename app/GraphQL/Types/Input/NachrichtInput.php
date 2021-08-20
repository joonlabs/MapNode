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

class NachrichtInput extends Definition
{

    static ?object $instance = null;

    /**
     * @inheritDoc
     */
    public static function build(): object
    {
        return new GraphQLInputObjectType(
            "NachrichtInput",
            "Eine neue Nachricht",
            function () {
                return [
                    new GraphQLTypeField(
                        "eintrag_id",
                        new GraphQLNonNull(new GraphQLInt()),
                    ),
                    new GraphQLTypeField(
                        "buerger_id",
                        new GraphQLNonNull(new GraphQLInt()),
                    ),
                    new GraphQLTypeField(
                        "inhalt",
                        new GraphQLNonNull(new GraphQLString()),
                    ),
                ];
            });
    }
}