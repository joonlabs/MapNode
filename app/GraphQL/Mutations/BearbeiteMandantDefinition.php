<?php

namespace App\GraphQL\Mutations;

use App\GraphQL\Types\Eintrag;
use App\GraphQL\Types\Input\EintragInput;
use App\GraphQL\Types\Input\MandantInput;
use App\GraphQL\Types\Input\NachrichtInput;
use App\GraphQL\Types\Login;
use App\GraphQL\Types\Mandant;
use App\GraphQL\Types\Nachricht;
use App\GraphQL\Utilities\Definition;
use App\Models\Benutzer;
use Curfle\Auth\JWT\JWT;
use Curfle\Http\Request;
use Curfle\Support\Facades\Auth;
use GraphQL\Arguments\GraphQLFieldArgument;
use GraphQL\Errors\BadUserInputError;
use GraphQL\Errors\UnauthenticatedError;
use GraphQL\Fields\GraphQLTypeField;
use GraphQL\Types\GraphQLInt;
use GraphQL\Types\GraphQLNonNull;
use GraphQL\Types\GraphQLString;

class BearbeiteMandantDefinition extends Definition
{

    static ?object $instance = null;

    /**
     * @inheritDoc
     */
    public static function build(): object
    {
        return new GraphQLTypeField(
            "bearbeiteMandant",
            Mandant::get(),
            "Bearbeitet einen Mandant",
            function ($_, $args) {
                // validate request
                if(!Auth::validate(Request::capture()))
                    throw new UnauthenticatedError("Missing or invalid token.");

                // obtain entry
                $mandant = \App\Models\Mandant::get($args["id"]);

                // update values
                foreach ($args["mandant"] as $key => $value){
                    if ($value !== NULL){
                        $mandant->{$key} = $value;
                    }
                }

                // update entry
                return $mandant->update();
            },
            [
                new GraphQLFieldArgument("id", new GraphQLNonNull(new GraphQLInt())),
                new GraphQLFieldArgument("mandant", new GraphQLNonNull(MandantInput::get())),
            ]
        );
    }
}