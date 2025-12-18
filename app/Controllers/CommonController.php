<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Helpers\JwtHelper;

class CommonController extends BaseController
{
    public function __construct() {}


    public function getLoggedUserDetails()
    {
        $getCookiesToken = $this->request->getCookie('access_token');
        if (empty($getCookiesToken)) {
            return redirect()->to(LOGIN_URL);
        }
        $loggedUserValue = JwtHelper::verifyToken($getCookiesToken);
        $result = ['userDetails' => $loggedUserValue->data ?? []];
        return   $result;
    }
    
}
