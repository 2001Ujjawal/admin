<?php

namespace App\Services;

use App\Helpers\JwtHelper;
use App\Services\SessionService;

class AdminAuthService
{
    protected $sessionService;

    public function __construct()
    {
        $this->sessionService = new SessionService();
    }

    public function login(array $requestData)
    {
        $userEmail = $requestData['email'] ?? null;
        $userPassword = $requestData['password'] ?? null;

        if (empty($userEmail)) {
            $this->sessionService->error('Please enter a valid email');
            return false;
        }

        if (empty($userPassword)) {
            $this->sessionService->error('Please enter a password');
            return false;
            
        }

        if ($userEmail === 'u5459607@gmail.com' && $userPassword === '123456') {
            $this->sessionService->success('Login successful');
            return true;
        }

        $this->sessionService->error('Invalid email or password');
        return false;
    }

 
}
