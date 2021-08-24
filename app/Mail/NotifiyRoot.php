<?php

namespace App\Mail;

use Curfle\Mail\Mailable;

class NotifiyRoot extends Mailable
{

    /**
     * @param string $userName
     * @param string $link
     */
    public function __construct(
        public string $content,
        public string $link
    )
    {
    }

    /**
     * @inheritDoc
     */
    public function subject(): string
    {
        return "Neue Interaktion";
    }

    /**
     * @inheritDoc
     */
    public function content(): string
    {
        return "<b>Guten Tag,</b><br><br>" .
            "Es gab eine neue Interaktion auf einer Karte:.<br>" .
            "{$this->content}<br><br>" .
            "Mehr Informationen sind auf der Karte zu finden:<br>" .
            "<a href='{$this->link}'>{$this->link}</a><br><br>" .
            "Viele Grüße<br>" .
            env("MAIL_FROM_NAME");
    }
}