<?php

namespace App\Controllers;

use App\Controllers\CommonController;


class BooksController extends CommonController
{
    protected $loggedUserValue;

    public function __construct()
    {
        $this->loggedUserValue =  $this->getLoggedUserDetails();
    }

    public function index()
    {

        $headerData = [
            'pageTitle' => 'Books-management',
            'metaTitle' => 'admin',
        ];
        $sidebar = [
            'sidebar' => 'books'
        ];
        // prt($sidebar) ; 
        return  view(HEADER, $headerData) .
            view(NAVBAR) .
            view(SIDEBAR, $sidebar) .
            view('admin/books') .
            view(FOOTER);
    }
}
