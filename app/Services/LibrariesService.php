<?php

namespace App\Services;

use App\Models\{
    LibraryModel as LM
};
use App\Helpers\ResponseHelper;

class LibrariesService
{
    protected LM $libraryModel;

    public function __construct()
    {
        $this->libraryModel = new LM();
    }

    public function addLibrary(array $requestData): object
    {
        $password = $this->generateHashPassword($requestData['name']);
        $insertDataPayload = [
            'uid'        => generateUid(),
            'name'       => $requestData['name'] ?? null,
            'email'      => $requestData['email'] ?? null,
            'address'    => $requestData['address'] ?? null,
            'phone_no'   => $requestData['phone_no'] ?? null,
            'reg_no'     => $requestData['reg_no']   ?? null,
            'password'   => $password['hashPassword'],
            'created_by' => null,
            'address'   => $requestData['address'] ?? null,
        ];


        if (!$this->libraryModel->insert($insertDataPayload)) {
            // $resetMessage = reset($this->libraryModel->errors());
            return ResponseHelper::error(
                422,
                'resetMessage',
                $this->libraryModel->errors()
            );
        }


        return ResponseHelper::success(
            201,
            'Library added successfully',
            [
                'uid' => $insertDataPayload['uid'],
                'password' => $password['rowPassword'],
            ]
        );
    }

    public function generateHashPassword(string $userName): array
    {
        $password  = rand(1000, 9999) . '_' . $userName;
        $hashPassword = password_hash($password, PASSWORD_DEFAULT);
        return [
            'rowPassword' => $password,
            'hashPassword' => $hashPassword
        ];
    }

    
}
