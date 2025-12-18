<?php

namespace App\Controllers;

use App\Controllers\CommonController;


class UserController extends CommonController
{
    public function index()
    {
        $loggedUserValue =  $this->getLoggedUserDetails();
        prt($loggedUserValue);
        return "hello";
    }
}
