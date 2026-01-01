<?php

namespace App\Interfaces;

interface EmailInterface
{
    public function emailSend(string $email, int $otp);
}
