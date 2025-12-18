<?php

namespace App\Controllers;

use App\Controllers\CommonController;


class DashboardController extends CommonController
{
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
            view(FOOTER);
    }
}
