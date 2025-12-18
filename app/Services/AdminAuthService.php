<?php

namespace App\Services;

use App\Helpers\JwtHelper;


class AdminAuthService
{


    public function login(array $requestData, $session)
    {
        $userEmail = $requestData['email'] ?? null;
        $userPassword = $requestData['password'] ?? null;

        if (empty($userEmail)) {
            $session->setFlashdata('error', 'Please enter a valid email');
            return false;
        }

        if (empty($userPassword)) {
            $session->setFlashdata('error', 'Please enter a password');
            return false;
        }

        if ($userEmail === 'u5459607@gmail.com' && $userPassword === '123456') {
            $session->setFlashdata('success', 'Login successful');
            return true;
        }

        $session->setFlashdata('error', 'Invalid email or password');
        return false;
    }
}
