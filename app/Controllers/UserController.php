<?php

namespace App\Controllers;

use App\Controllers\CommonController;


class UserController extends CommonController
{
    protected $loggedUserValue;

    public function __construct()
    {
        $this->loggedUserValue =  $this->getLoggedUserDetails();
    }

    public function index()
    {
        
    }
}
