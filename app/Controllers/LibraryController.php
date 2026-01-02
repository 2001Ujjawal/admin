<?php

namespace App\Controllers;

use App\Controllers\CommonController;


class LibraryController extends CommonController
{
    protected array $loggedUserValue;

    public function __construct() {}

    public function index()
    {
        $this->loggedUserValue =  $this->getLoggedUserDetails();
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
