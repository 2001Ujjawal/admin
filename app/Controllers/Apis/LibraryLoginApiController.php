<?php

namespace App\Controllers\Apis;

use App\Controllers\Apis\BaseApiController;
use App\Services\{
    ForgotPasswordService,
    LibrariesService,
    LibraryAuthService,
    OtpService
};
use Config\Services;

class LibraryLoginApiController extends BaseApiController
{
    protected LibraryAuthService $libraryAuthService;
    protected $forgotPasswordService;
    protected  $otpService;
    public function __construct()
    {
        $this->libraryAuthService = new LibraryAuthService();
        $this->forgotPasswordService = new ForgotPasswordService();

        $this->otpService = Services::otpService();
    }



    public function login()
    {
        $requestData = $this->request->getJSON(true) ?? [];
        $login = $this->libraryAuthService->login($requestData);
        return $this->sendApiResponse($login);
    }

    public function  sendOtp(string $otpSendType = null)
    {
        $requestData = $this->request->getJSON(true) ?? [];

        if ($otpSendType !== null && $otpSendType === 'resend') {
            $otpSend = $this->otpService->resendOtp($requestData, 'library');
        }

        $otpSend = $this->otpService->sendOtp($requestData, 'library');
        return $this->sendApiResponse($otpSend);
    }


    public function verifyOtp()
    {
        $requestData = $this->request->getJSON(true) ?? [];
        $verifyOtp = $this->otpService->verifyOtp($requestData, 'library');
        return $this->sendApiResponse($verifyOtp);
    }


    public function createNewPassword()
    {
        $requestData = $this->request->getJSON(true) ?? [];
        $createNewPassword = $this->forgotPasswordService->createNewPassword($requestData, 'library');
        return $this->sendApiResponse($createNewPassword);
    }
}
