<?php

namespace App\Controllers;

use App\Controllers\CommonController;


class LibraryController extends CommonController
{
    protected $loggedUserValue;

    public function __construct()
    {
        $this->loggedUserValue =  $this->getLoggedUserDetails();
    }

    public function index()
    {

        $headerData = [
            'pageTitle' => 'Libraries',
            'metaTitle' => 'admin',
        ];
        $sidebar = [
            'sidebar' => 'libraries'
        ];
        // prt($sidebar) ; 
        return  view(HEADER, $headerData) .
            view(NAVBAR) .
            view(SIDEBAR, $sidebar) .
            view('admin/libraries') .
            view(FOOTER);
    }
}
