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
use GraphQL\Types\GraphQLBoolean;
use GraphQL\Types\GraphQLInt;
use GraphQL\Types\GraphQLNonNull;
use GraphQL\Types\GraphQLString;

class BearbeiteEintragDefinition extends Definition
{

    static ?object $instance = null;

    /**
     * @inheritDoc
     */
    public static function build(): object
    {
        return new GraphQLTypeField(
            "bearbeiteEintrag",
            new GraphQLNonNull(new GraphQLBoolean()),
            "Bearbeitet einen Eintrag",
            function ($_, $args) {
                // validate request
                if(!Auth::validate(Request::capture()))
                    throw new UnauthenticatedError("Missing or invalid token.");

                // obtain entry
                $eintrag = \App\Models\Eintrag::get($args["id"]);

                // update values
                foreach ($args["eintrag"] as $key => $value){
                    if ($value !== NULL){
                        $eintrag->{$key} = $value;
                    }
                }

                // update entry
                return $eintrag->update();
            },
            [
                new GraphQLFieldArgument("id", new GraphQLNonNull(new GraphQLInt())),
                new GraphQLFieldArgument("eintrag", new GraphQLNonNull(EintragInput::get())),
            ]
        );
    }
}