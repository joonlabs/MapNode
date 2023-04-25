<?php

namespace App\GraphQL\Mutations;

use App\GraphQL\Types\Eintrag;
use App\GraphQL\Types\Input\EintragInput;
use App\GraphQL\Types\Login;
use App\GraphQL\Utilities\Definition;
use App\Mail\ConfirmEintrag;
use App\Models\Benutzer;
use Curfle\Auth\JWT\JWT;
use Curfle\Http\Request;
use Curfle\Support\Facades\Auth;
use Curfle\Support\Facades\Mail;
use GraphQL\Arguments\GraphQLFieldArgument;
use GraphQL\Errors\BadUserInputError;
use GraphQL\Errors\UnauthenticatedError;
use GraphQL\Fields\GraphQLTypeField;
use GraphQL\Types\GraphQLBoolean;
use GraphQL\Types\GraphQLInt;
use GraphQL\Types\GraphQLNonNull;
use GraphQL\Types\GraphQLString;

class UpvoteEintragDefinition extends Definition
{

    static ?object $instance = null;

    /**
     * @inheritDoc
     */
    public static function build(): object
    {
        return new GraphQLTypeField(
            "upvoteEintrag",
            new GraphQLNonNull(new GraphQLBoolean()),
            "Upvote einen Eintrag",
            function ($_, $args) {

                // obtain entry
                $eintrag = \App\Models\Eintrag::get($args["id"]);

                // update values
                $eintrag->upvotes++;

                // update entry
                return $eintrag->update();
            },
            [
                new GraphQLFieldArgument("id", new GraphQLNonNull(new GraphQLInt())),
            ]
        );
    }
}