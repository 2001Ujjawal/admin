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

    public function sendOtp(array $requestData, string $userType)
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
        $checkEmailExits = $this->libraryModel->checkLibraryExits($email);
        if (!$checkEmailExits) {
            return ResponseHelper::error(404, 'Email not found');
        }

        $otp = 1234;
        $systemOtp = generateOtp();

        $otpSaveDataPayload = [
            'uid' => generateUid(),
            'hash_otp' => password_hash($otp, PASSWORD_DEFAULT),
            'system_otp' => $systemOtp,
            'user_id' => $checkEmailExits->uid,
            'value' => $email,
            'purpose' => 'forgot_password',
            'otp_send_type' => 'email',
            'user_type' => $userType ?? 'library'
        ];

        $storeOtp = $this->otpModel->storeOtp($otpSaveDataPayload);
        if (!$storeOtp) {
            return ResponseHelper::error(500, 'Failed to send');
        }

        // $sent = $this->emailService->emailSend(
        //     $email,
        //     'Your OTP Code',
        //     "Your OTP is: {$otp}"
        // );

        // if (!$sent) {
        //     return ResponseHelper::error(500, 'OTP email sending failed');
        // }
        $otpDetails = [
            'systemOtp' => $systemOtp,
        ];
        return ResponseHelper::success(200, 'OTP resend sent successfully', ['otpDetails' => $otpDetails]);
    }

    public function resendOtp(array $requestData, string $userType)
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
        $checkEmailExits = $this->libraryModel->checkLibraryExits($email);
        if (!$checkEmailExits) {
            return ResponseHelper::error(404, 'Email not found');
        }

        $otp = 1234;
        $systemOtp = generateOtp();

        $otpSaveDataPayload = [
            'uid' => generateUid(),
            'hash_otp' => password_hash($otp, PASSWORD_DEFAULT),
            'system_otp' => $systemOtp,
            'user_id' => $checkEmailExits->uid,
            'value' => $email,
            'purpose' => 'forgot_password',
            'otp_send_type' => 'email',
            'user_type' => $userType ?? 'library'
        ];

        $storeOtp = $this->otpModel->storeOtp($otpSaveDataPayload);
        if (!$storeOtp) {
            return ResponseHelper::error(500, 'Failed to send');
        }

        // $sent = $this->emailService->emailSend(
        //     $email,
        //     'Your OTP Code',
        //     "Your OTP is: {$otp}"
        // );

        // if (!$sent) {
        //     return ResponseHelper::error(500, 'OTP email sending failed');
        // }
        $otpDetails = [
            'systemOtp' => $systemOtp,
        ];
        return ResponseHelper::success(200, 'OTP sent successfully', ['otpDetails' => $otpDetails]);
    }
}
