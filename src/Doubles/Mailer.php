<?php

namespace App\Doubles;

class Mailer
{
    public function send($message)
    {
        var_dump($message);
    }
}