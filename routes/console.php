<?php

use Curfle\Support\Facades\Buddy;

/**
 * This file is where you may define all of your Closure based console
 * commands. Each Closure is bound to a command instance allowing a
 * simple approach to interacting with each command's IO methods.
 */

Buddy::command('inspire', function (\Curfle\Console\Input $input) {
    $inspiring = [
        "“Ruby is rubbish! PHP is phpantastic!” – Nikita Popov",
        "“Simplicity is the soul of efficiency.” – Austin Freeman",
        "“Code is like humor. When you have to explain it, it’s bad.” – Cory House"
    ];
    $this->write($inspiring[array_rand($inspiring)]);
});