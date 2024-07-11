<?php

namespace App\Doubles;

class User
{
    protected $name;
    /**
     * @var true
     */
    private bool $subscribed = false;

    function __construct($name)
    {
        $this->name = $name;
    }

    public function isSubscribed()
    {
        return $this->subscribed;
    }

    public function setAsSubscribed()
    {
        $this->subscribed = true;
    }


}