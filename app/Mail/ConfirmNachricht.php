<?php

namespace App\Mail;

use Curfle\Mail\Mailable;

class ConfirmNachricht extends Mailable
{

    /**
     * @param string $userName
     * @param string $link
     */
    public function __construct(
        public string $userName,
        public string $link
    )
    {
    }

    /**
     * @inheritDoc
     */
    public function subject(): string
    {
        return "Bestätigung | MapNode";
    }

    /**
     * @inheritDoc
     */
    public function content(): string
    {
        return "<b>Guten Tag {$this->userName},</b><br><br>" .
            "Vielen Dank für Ihre Nachricht. Es fehlt noch ein kleiner Schritt bis zur Veröffentlichung.<br>" .
            "Bitte bestätigen Sie Ihre eben erstellten Nachricht, indem Sie auf den unten stehenden Link klicken.<br><br>" .
            "<a href='{$this->link}'>{$this->link}</a><br><br>" .
            "Viele Grüße<br>" .
            env("MAIL_FROM_NAME");
    }
}