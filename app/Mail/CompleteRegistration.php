<?php

namespace App\Mail;

use Curfle\Mail\Mailable;

class CompleteRegistration extends Mailable
{

    /**
     * @inheritDoc
     */
    public function subject(): string
    {
        return "Welcome to Curfle";
    }

    /**
     * @inheritDoc
     */
    public function content(): string
    {
        return "<b>Hey there,</b><br>enjoy using Curfle!<br><br>Cheers!";
    }
}