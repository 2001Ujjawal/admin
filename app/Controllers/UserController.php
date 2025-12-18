<?php

namespace App\Controllers;

use App\Controllers\CommonController;
use App\Helpers\JwtHelper;

class UserController extends CommonController
{
    public function index()
    {
        // $token = $this->request->getCookie('access_token');
        // $checkTokenValue = JwtHelper::verifyToken($token);
        // prt($checkTokenValue, false);

        return "hello";
    }
}
