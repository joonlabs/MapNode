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

class Eintrag extends Definition
{

    static ?object $instance = null;
    /**
     * @inheritDoc
     */
    public static function build(): object
    {
        return new GraphQLObjectType(
            "Eintrag",
            "Ein Karteneintrag",
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
                        "status",
                        new GraphQLNonNull(new GraphQLInt()),
                    ),
                    new GraphQLTypeField(
                        "upvotes",
                        new GraphQLNonNull(new GraphQLInt()),
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
                        "kategorie",
                        new GraphQLNonNull(Kategorie::get())
                    ),
                    new GraphQLTypeField(
                        "buerger",
                        new GraphQLNonNull(Buerger::get()),
                    ),
                    new GraphQLTypeField(
                        "nachrichten",
                        new GraphQLList(new GraphQLNonNull(Nachricht::get())),
                    ),
                    new GraphQLTypeField(
                        "bestaetigt",
                        new GraphQLNonNull(new GraphQLBoolean()),
                    ),
                    new GraphQLTypeField(
                        "chat_verfuegbar",
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