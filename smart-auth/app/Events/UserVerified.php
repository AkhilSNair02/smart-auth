<?php

namespace App\Events;

class UserVerified
{
    public $user;

    public function __construct($user)
    {
        $this->user = $user;
    }
}