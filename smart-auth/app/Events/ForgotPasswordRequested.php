<?php

namespace App\Events;

class ForgotPasswordRequested
{
    public $user;
    public $otp;

    public function __construct($user, $otp)
    {
        $this->user = $user;
        $this->otp  = $otp;
    }
}