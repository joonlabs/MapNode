<?php

namespace App\GraphQL\Mutations;

use App\GraphQL\Types\Eintrag;
use App\GraphQL\Types\Input\EintragInput;
use App\GraphQL\Types\Input\NachrichtInput;
use App\GraphQL\Types\Login;
use App\GraphQL\Types\Nachricht;
use App\GraphQL\Utilities\Definition;
use App\Mail\ConfirmEintrag;
use App\Mail\ConfirmNachricht;
use App\Models\Benutzer;
use App\Models\Buerger;
use Curfle\Auth\JWT\JWT;
use Curfle\Support\Facades\Auth;
use Curfle\Support\Facades\Mail;
use GraphQL\Arguments\GraphQLFieldArgument;
use GraphQL\Errors\BadUserInputError;
use GraphQL\Fields\GraphQLTypeField;
use GraphQL\Types\GraphQLNonNull;
use GraphQL\Types\GraphQLString;

class ErstelleNachrichtDefinition extends Definition
{

    static ?object $instance = null;

    /**
     * @inheritDoc
     */
    public static function build(): object
    {
        return new GraphQLTypeField(
            "erstelleNachricht",
            Nachricht::get(),
            "Erstellt eine neue Nachricht",
            function ($_, $args) {
                // remove null inputs
                foreach ($args["nachricht"] as $key => $value)
                    if ($value === NULL) unset($args["nachricht"][$key]);

                // create entry
                $nachricht = \App\Models\Nachricht::create($args["nachricht"]);

                // send mail
                $buerger = Buerger::get($args["nachricht"]["buerger_id"]);
                Mail::to($buerger->email)
                    ->send(new ConfirmNachricht(
                        $buerger->vorname . " " . $buerger->nachname,
                        env("APP_URL") . "/confirm/nachricht/{$nachricht->id}"
                    ));
            },
            [
                new GraphQLFieldArgument("nachricht", new GraphQLNonNull(NachrichtInput::get())),
            ]
        );
    }
}