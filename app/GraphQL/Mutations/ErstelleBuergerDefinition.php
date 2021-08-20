<?php

namespace App\GraphQL\Mutations;

use App\GraphQL\Types\Buerger;
use App\GraphQL\Types\Eintrag;
use App\GraphQL\Types\Input\BuergerInput;
use App\GraphQL\Types\Input\EintragInput;
use App\GraphQL\Types\Login;
use App\GraphQL\Utilities\Definition;
use App\Models\Benutzer;
use Curfle\Auth\JWT\JWT;
use Curfle\Support\Facades\Auth;
use GraphQL\Arguments\GraphQLFieldArgument;
use GraphQL\Errors\BadUserInputError;
use GraphQL\Fields\GraphQLTypeField;
use GraphQL\Types\GraphQLNonNull;
use GraphQL\Types\GraphQLString;

class ErstelleBuergerDefinition extends Definition
{

    static ?object $instance = null;

    /**
     * @inheritDoc
     */
    public static function build(): object
    {
        return new GraphQLTypeField(
            "erstelleBuerger",
            Buerger::get(),
            "Erstellt einen neuen Bürger",
            function ($_, $args) {
                // remove null inputs
                foreach ($args["buerger"] as $key => $value)
                    if ($value === NULL) unset($args["buerger"][$key]);

                // create entry
                return \App\Models\Buerger::create($args["buerger"]);
            },
            [
                new GraphQLFieldArgument("buerger", new GraphQLNonNull(BuergerInput::get())),
            ]
        );
    }
}