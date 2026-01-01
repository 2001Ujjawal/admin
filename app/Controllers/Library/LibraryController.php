<?php

namespace App\Controllers\Library;

use App\Controllers\CommonController;


class LibraryController extends CommonController
{
    protected array $loggedUserValue;

    public function __construct() {}
    public function loginPageView()
    {
        return view('library/library_login');
    }
  
}
