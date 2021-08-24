<?php

namespace App\Mail;

use Curfle\Mail\Mailable;

class NotifiyMessageOwner extends Mailable
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
        return "Neue Nachricht in einem Eintrag";
    }

    /**
     * @inheritDoc
     */
    public function content(): string
    {
        return "<b>Guten Tag {$this->userName},</b><br><br>" .
            "Es wurde eine neue Nachricht zu einem Eintrag erstellt, zu welchem Sie ebenfalls eine Nachricht geschrieben haben.<br>" .
            "Besuchen Sie den folgenden Link, um Ihren Eintrag aufzurufen und sich die Nachricht anzusehen.<br>" .
            "<a href='{$this->link}'>{$this->link}</a><br><br>" .
            "Viele Grüße<br>" .
            env("MAIL_FROM_NAME");
    }
}