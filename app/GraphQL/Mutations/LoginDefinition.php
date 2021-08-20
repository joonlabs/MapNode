<?php

namespace App\GraphQL\Mutations;

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

class LoginDefinition extends Definition
{
    protected static ?object $instance = null;

    /**
     * @inheritDoc
     */
    public static function build(): object
    {
        return new GraphQLTypeField(
            "login",
            Login::get(),
            "Loggt einen Benutzer ein",
            function ($_, $args) {
                // try to login user
                if (Auth::attempt($args)) {
                    $user = Benutzer::get(Benutzer::where("email", $args["email"])->first()["id"]);
                    $token = JWT::generate([
                        "sub" => $user->id,
                        "vorname" => $user->vorname,
                        "nachname" => $user->nachname,
                        "email" => $user->email,
                        "benutzerrolle" => $user->benutzerrolle,
                        "erstellt" => $user->erstellt,
                    ]);
                    return ["token" => $token];
                }
                // throw error otherwise
                throw new BadUserInputError("The credentials provided are not correct");
            },
            [
                new GraphQLFieldArgument("email", new GraphQLNonNull(new GraphQLString())),
                new GraphQLFieldArgument("passwort", new GraphQLNonNull(new GraphQLString()))
            ]
        );
    }
}