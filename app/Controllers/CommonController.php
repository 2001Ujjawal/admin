<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Helpers\JwtHelper;
use CodeIgniter\Cookie\Cookie;
use App\Interfaces\SessionServiceInterface;
use App\Services\{
    SessionService,
};

class CommonController extends BaseController
{

    protected  $sessionService;

    public function __construct()
    {
        // Depend on interface, not concrete class
        $this->sessionService = new SessionService();
    }

    public function getLoggedUserDetails(): array
    {
        $request = \Config\Services::request();
        $getCookiesToken = $request->getCookie('access_token');
        if (empty($getCookiesToken)) {
            $this->sessionService->error('Token expired !! ');
            return redirect()->to(LOGIN_URL);
        }
        $loggedUserValue = JwtHelper::verifyToken($getCookiesToken);
        $result = ['userDetails' => $loggedUserValue->data ?? []];
        return   $result;
    }
}
