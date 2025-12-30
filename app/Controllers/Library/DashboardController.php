<?php

namespace App\Controllers\Library;

use App\Controllers\CommonController;


class DashboardController extends CommonController
{
    protected $loggedUserValue;

    public function __construct()
    {
        $this->loggedUserValue =  $this->getLoggedUserDetails();
    }
    public function index()
    {
        $headerData = [
            'pageTitle' => 'Dashboard',
            'metaTitle' => 'admin',

        ];
        $sidebar = [
            'sidebar' => 'students'
        ];
        return
            view(LIBRARY_HEADER, $headerData) .
            view(LIBRARY_NAVBAR) .
            view(LIBRARY_SIDEBAR, $sidebar) .
            view('library/dashboard') .
            view(LIBRARY_FOOTER);
    }
}
