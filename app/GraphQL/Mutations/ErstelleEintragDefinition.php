<?php

namespace App\GraphQL\Mutations;

use App\GraphQL\Types\Eintrag;
use App\GraphQL\Types\Input\EintragInput;
use App\GraphQL\Types\Login;
use App\GraphQL\Utilities\Definition;
use App\Models\Benutzer;
use Curfle\Auth\JWT\JWT;
use Curfle\Http\Request;
use Curfle\Support\Facades\Auth;
use GraphQL\Arguments\GraphQLFieldArgument;
use GraphQL\Errors\BadUserInputError;
use GraphQL\Errors\UnauthenticatedError;
use GraphQL\Fields\GraphQLTypeField;
use GraphQL\Types\GraphQLNonNull;
use GraphQL\Types\GraphQLString;

class ErstelleEintragDefinition extends Definition
{

    static ?object $instance = null;

    /**
     * @inheritDoc
     */
    public static function build(): object
    {
        return new GraphQLTypeField(
            "erstelleEintrag",
            Eintrag::get(),
            "Erstellt einen neuen Eintrag",
            function ($_, $args) {
                // remove null inputs
                foreach ($args["eintrag"] as $key => $value)
                    if ($value === NULL) unset($args["eintrag"][$key]);

                // create entry
                return \App\Models\Eintrag::create($args["eintrag"]);
            },
            [
                new GraphQLFieldArgument("eintrag", new GraphQLNonNull(EintragInput::get())),
            ]
        );
    }
}