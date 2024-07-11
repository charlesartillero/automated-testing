<?php

namespace App\Doubles;

class Gateway implements GatewayInterface
{

    public function create()
    {
        var_dump('Slow HTTP request in progress. 123');
    }
}
