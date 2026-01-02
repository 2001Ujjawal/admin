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

    public function getLoggedUserDetails(string $requestUrl = 'admin'): ?array
    {
        $request = \Config\Services::request();
        $getCookiesToken = $request->getCookie(getenv('COOKIE_NAME'));
        if (empty($getCookiesToken)) {
            $this->sessionService->error('Token expired !! ');
            if ($requestUrl === 'library') {
                return redirect()->to(LIBRARY_LOGIN_URL);
            }
            return redirect()->to(LOGIN_URL);
        }
        $loggedUserValue = JwtHelper::verifyToken($getCookiesToken);
        $result = ['userDetails' => $loggedUserValue->data ?? []];
        return   $result;
    }
    
}
