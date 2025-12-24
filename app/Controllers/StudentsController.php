<?php

namespace App\Controllers;

use App\Controllers\CommonController;


class StudentsController extends CommonController
{
    protected $loggedUserValue;

    public function __construct()
    {
        $this->loggedUserValue =  $this->getLoggedUserDetails();
    }

    public function index()
    {

        $headerData = [
            'pageTitle' => 'Students',
            'metaTitle' => 'admin',
        ];
        $sidebar = [
            'sidebar' => 'students'
        ];
        // prt($sidebar) ; 
        return  view(HEADER, $headerData) .
            view(NAVBAR) .
            view(SIDEBAR, $sidebar) .
            view('admin/students') .
            view(FOOTER);
    }
}
