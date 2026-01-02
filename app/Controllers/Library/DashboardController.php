<?php

namespace App\Controllers\Library;

use App\Controllers\CommonController;


class DashboardController extends CommonController
{
    protected $loggedUserValue;
    protected string $requestUrl = 'library';
    public function __construct()
    {
        $this->loggedUserValue =  $this->getLoggedUserDetails($this->requestUrl);
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
