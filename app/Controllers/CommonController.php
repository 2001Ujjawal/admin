<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Helpers\JwtHelper;
use CodeIgniter\Cookie\Cookie;

class CommonController extends BaseController
{

    public function getLoggedUserDetails()
    {
        $request = \Config\Services::request();
        
        $getCookiesToken = $request->getCookie('access_token');
        if (empty($getCookiesToken)) {
            return redirect()->to(LOGIN_URL);
        }
        $loggedUserValue = JwtHelper::verifyToken($getCookiesToken);
        $result = ['userDetails' => $loggedUserValue->data ?? []];
        return   $result;
    }
}
