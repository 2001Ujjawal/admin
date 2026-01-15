<?php


namespace App\Services;

use App\Helpers\{
    checkValidationRulesHelper,
    ResponseHelper
};
use App\Models\{
    LibraryModel
};

class ForgotPasswordService
{
    protected $libraryModel;
    public function __construct()
    {
        $this->libraryModel = new LibraryModel();
    }
    public function createNewPassword(array $requestData, $userType = 'library')
    {
        $validated = checkValidationRulesHelper::validateData(
            'changePasswordRules',
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

        $newPassword = $requestData['new_password'];
        //$checkEmailExits->id
        $passwordUpdate = $this->libraryModel->passwordUpdate($newPassword, $checkEmailExits->id);
        if ($passwordUpdate === false) {
            return ResponseHelper::error(500, 'Please try again ');
        };
        return   ResponseHelper::success(HTTP_OK, 'Create new password successFully');
    }
}
