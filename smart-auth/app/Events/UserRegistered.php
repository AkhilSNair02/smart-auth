<?php

namespace App\Events;

class UserRegistered
{
    public $user;
    public $otp;

    public function __construct($user, $otp)
    {
        $this->user = $user;
        $this->otp  = $otp;
    }
}