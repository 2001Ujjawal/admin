<?php

namespace App\Interfaces;

interface EmailInterface
{
    public function emailSend(string|array $email,  string $subject,  string $message);
}
