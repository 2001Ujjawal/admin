<?php

namespace App\Controllers\Library;

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
        return  view(LIBRARY_HEADER, $headerData) .
            view(LIBRARY_NAVBAR) .
            view(LIBRARY_SIDEBAR, $sidebar) .
            view('library/books') .
            view(LIBRARY_FOOTER);
    }
}
