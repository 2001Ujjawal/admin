<?php

namespace App\Controllers\Apis;

use App\Controllers\Apis\BaseApiController;
use App\Services\{LibrariesService, LibraryAuthService, OtpService};
use Config\Services;

class LibraryLoginApiController extends BaseApiController
{
    protected LibraryAuthService $libraryAuthService;
    protected  $otpService;
    public function __construct()
    {
        $this->libraryAuthService = new LibraryAuthService();
        $this->otpService = Services::otpService();
    }



    public function login()
    {
        $requestData = $this->request->getJSON(true) ?? [];
        $login = $this->libraryAuthService->login($requestData);
        return $this->sendApiResponse($login);
    }

    public function  sendOtp()
    {
        $requestData = $this->request->getJSON(true) ?? [];
        $otpSend = $this->otpService->sendOtp($requestData);
        return $this->sendApiResponse($otpSend);
    }
}
