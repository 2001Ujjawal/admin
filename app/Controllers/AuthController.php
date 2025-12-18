<?php

namespace App\Controllers;

use CodeIgniter\Cookie\Cookie;
use App\Helpers\JwtHelper;
use App\Services\{
    AdminAuthService,
    SessionService
};

class AuthController extends CommonController
{
    protected AdminAuthService $adminAuthService;

    public function __construct()
    {
        $this->adminAuthService = new AdminAuthService();
        $this->sessionService = new SessionService();
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
        $loginSuccess = $this->adminAuthService->login($postRequest);
        if ($loginSuccess) {
            $response =   JwtHelper::setCookieToken($postRequest);
            if (empty($response)) {
                $this->sessionService->error('Token Creation Failed');
                return redirect()->back()->withInput();
            }
            return $response->redirect('/dashboard');
        } else {
            return redirect()->back()->withInput();
        }
    }

    public function logout()
    {
        $response = service('response');
        $response->deleteCookie(
            'access_token',
            '',    
            '/'  
        );
        session()->destroy();
        return $response->redirect(base_url('login'));
    }
}
