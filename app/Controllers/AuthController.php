<?php

namespace App\Controllers;

use App\Helpers\JwtHelper;

class AuthController extends BaseController
{
    public function index()
    {
        return view('admin/login');
    }

    public function cookie()
    {
        $payload = [
            'userName' => 'Xyz',
            'role'     => 'admin'
        ];
        try {
            $response = JwtHelper::setCookieToken($payload);
            return $response->redirect('/users');
        } catch (\Throwable $th) {
            print_r($th);
        }
    }
}
