<?php

namespace App\Controllers;

use App\Helpers\JwtHelper;
use App\Services\{
    AdminAuthService
};

class AuthController extends BaseController
{
    protected AdminAuthService $adminAuthService;
    protected $session;
    public function __construct()
    {
        $this->adminAuthService = new AdminAuthService();
        $this->session = session();
    }
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


    public function authLogin()
    {
        $postRequest = $this->request->getPost();
        $loginSuccess = $this->adminAuthService->login($postRequest, $this->session);
        if ($loginSuccess) {
            $response =   JwtHelper::setCookieToken($postRequest);
            if (empty($response)) {
                $session->setFlashdata('error', 'Token Creation Failed');
                return redirect()->back()->withInput();
            }
            return $response->redirect('/users');
        } else {
            return redirect()->back()->withInput();
        }
    }
}
