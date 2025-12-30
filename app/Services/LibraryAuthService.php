<?php

namespace App\Services;

use CodeIgniter\I18n\Time;
use App\Helpers\{
    checkValidationRulesHelper,
    NumberToWordsHelper,
    ResponseHelper
};

use App\Models\{
    LibraryModel,
    LibraryLoginSessionModel,
    LibrarySettingModel
};

class LibraryAuthService
{
    protected LibraryModel $libraryModel;
    protected LibraryLoginSessionModel $libraryLoginSessionModel;
    protected LibrarySettingModel $librarySettingModel;

    public function __construct()
    {
        $this->libraryModel = new LibraryModel();
        $this->libraryLoginSessionModel = new LibraryLoginSessionModel();
        $this->librarySettingModel = new LibrarySettingModel();
    }

    public function login(array $requestData)
    {

        $validated = checkValidationRulesHelper::validateData('loginValidationRules', $requestData);

        if (!$validated['status']) {
            return ResponseHelper::error(422, $validated['first_error'], $validated['errors']);
        }

        $email = $requestData['email'] ?? '';
        $password = trim($requestData['password']) ?? '';

        $library = $this->libraryModel->checkLibraryExits($email);
        if (!$library) {
            return ResponseHelper::error(404, 'library not exists. Please register');
        }

        if (!password_verify($password, $library->password)) {
            return ResponseHelper::error(400, 'Incorrect password');
        }

        $libraryId = $library->uid;
        $phoneNo = $library->phone_no;


        $totalLibraryLoginSession =  $this->libraryLoginSessionModel->loginSessionCount($libraryId) ?? 0;

        $librarySettingDetails = $this->librarySettingModel->librarySettingDetails($libraryId) ?? null;

        $otpSendType = $librarySettingDetails->otp_send_type;
        $libraryAuthenticationValue = (bool) $librarySettingDetails->is_two_setup_authentication;
        $totalAllowLoginDevice = (int) $librarySettingDetails->allow_login_device ?? 1;

        if ($totalAllowLoginDevice <= $totalLibraryLoginSession) {
            $convertNumberToWords = NumberToWordsHelper::convertNumber($totalAllowLoginDevice);
            return ResponseHelper::error(400, "Only allow {$convertNumberToWords} device", ['errors' => 'its already login']);
        }

        $checkTwoSetupAuthenticationIsEnable = $this->checkTwoSetupAuthentication(
            $libraryAuthenticationValue,
            $otpSendType,
            $phoneNo,
            $email
        );

        $loginSession = $this->createLoginSession($email, $phoneNo, $libraryId);
        if (!$loginSession['loginSessionId']) {
            return ResponseHelper::error(400, 'Login Failed');
        }


        $loginLibraryData = [
            'libraryId' => $libraryId,
            'loginSessionId' => $loginSession['loginSessionId'],
            'twoSetupAuthentication' => $checkTwoSetupAuthenticationIsEnable['value'],
        ];

        return ResponseHelper::success(
            $checkTwoSetupAuthenticationIsEnable['statusCode'],
            $checkTwoSetupAuthenticationIsEnable['message'],
            ['loginUserData' => $loginLibraryData ?? null]
        );
    }

    private function createLoginSession(
        string $email,
        string $phoneNo,
        string $libraryUid
    ): array {

        $loginSessionUid = generateUid();
        $loginSessionPayload = [
            'uid' => $loginSessionUid,
            'email' => $email,
            'phone_no' => $phoneNo,
            'library_id' => $libraryUid,
            'login_details' => json_encode($this->getLoginDetails()) ?? null,
        ];

        if (!$this->libraryLoginSessionModel->insert($loginSessionPayload)) {
            return ['loginSessionId' => null];
        }
        return ['loginSessionId' => $loginSessionUid];
    }



    public function getLoginDetails(): array
    {
        $request = service('request');
        $ip = $request->getIPAddress();
        $agent = $request->getUserAgent();
        $loginDetails = [
            'ip_address' => $ip,
            'browser'    => $agent->getBrowser() . ' ' . $agent->getVersion(),
            'platform'   => $agent->getPlatform(),
            'login_time' => Time::now()->toDateTimeString(),
        ];
        return $loginDetails;
    }

    private function checkTwoSetupAuthentication(
        bool $libraryAuthenticationValue,
        string $otpSendType = SMS_SEND_TYPE_EMAIL,
        string $phoneNo,
        string $email,
    ): array {
        if ($libraryAuthenticationValue === false && $libraryAuthenticationValue == null) {
            return [
                'statusCode' => HTTP_OK,
                'value' => false,
                'message' => 'Login Successfully'
            ];
        }

        switch ($otpSendType) {
            case SMS_SEND_TYPE_EMAIL:
                //code block
                break;
            case SMS_SEND_TYPE_PHONE:
                //code block;
                break;
            case SMS_SEND_TYPE_WHATSAPP:
                //code block
                break;
            default:
                //code block
        }

        return [
            'statusCode' => HTTP_OK,
            'value' => true,
            'message' => "please check your $otpSendType "
        ];
    }
}
