<?php

namespace App\Services;

use App\Interfaces\EmailInterface;
use App\Models\OtpModel;
use App\Models\LibraryModel;
use App\Helpers\ResponseHelper;
use App\Helpers\checkValidationRulesHelper;

class OtpService
{
    protected OtpModel $otpModel;
    protected LibraryModel $libraryModel;
    protected EmailInterface $emailService;

    public function __construct(EmailInterface $emailService)
    {
        $this->otpModel     = new OtpModel();
        $this->libraryModel = new LibraryModel();
        $this->emailService = $emailService;
    }

    public function sendOtp(array $requestData)
    {
        $validated = checkValidationRulesHelper::validateData(
            'otpSendValidationRules',
            $requestData
        );

        if (!$validated['status']) {
            return ResponseHelper::error(
                422,
                $validated['first_error'],
                $validated['errors']
            );
        }

        $email = $requestData['email'];

        if (!$this->libraryModel->checkLibraryExits($email)) {
            return ResponseHelper::error(404, 'Email not found');
        }

        $otp = rand(100000, 999999);

        // Save OTP (example)
        // $this->otpModel->insert([
        //     'email' => $email,
        //     'otp'   => $otp
        // ]);

        $sent = $this->emailService->emailSend(
            $email,
            'Your OTP Code',
            "Your OTP is: {$otp}"
        );

        if (!$sent) {
            return ResponseHelper::error(500, 'OTP email sending failed');
        }

        return ResponseHelper::success(200, 'OTP sent successfully');
    }
}
