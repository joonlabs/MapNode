<?php

namespace App\GraphQL\Mutations;

use App\GraphQL\Types\Eintrag;
use App\GraphQL\Types\Input\EintragInput;
use App\GraphQL\Types\Login;
use App\GraphQL\Utilities\Definition;
use App\Mail\ConfirmEintrag;
use App\Models\Benutzer;
use App\Models\Buerger;
use Curfle\Auth\JWT\JWT;
use Curfle\Http\Request;
use Curfle\Support\Facades\Auth;
use Curfle\Support\Facades\Mail;
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
                $eintrag = \App\Models\Eintrag::create($args["eintrag"]);

                // send mail
                $buerger = Buerger::get($args["eintrag"]["buerger_id"]);
                Mail::to($buerger->email)
                    ->send(new ConfirmEintrag(
                        $buerger->vorname . " " . $buerger->nachname,
                        env("APP_URL") . "/confirm/eintrag/{$eintrag->id}"
                    ));

                // return entry
                return $eintrag;
            },
            [
                new GraphQLFieldArgument("eintrag", new GraphQLNonNull(EintragInput::get())),
            ]
        );
    }
}