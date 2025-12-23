<?php

namespace App\Controllers;

use App\Controllers\CommonController;
use App\Services\SessionService;

class DashboardController extends CommonController
{
    protected $sessionService;

    public function __construct()
    {
        $this->sessionService = new SessionService;
    }
    public function index()
    {
        $headerData = [
            'pageTitle' => 'Dashboard',
            'metaTitle' => 'admin',

        ];
        return
            view(HEADER, $headerData) .
            view(NAVBAR) .
            view(SIDEBAR) .
            view('admin/dashboard') .
            view('admin/js/commonJs.php') .
            view(FOOTER);
    }
}
