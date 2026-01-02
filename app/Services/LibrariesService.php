<?php

namespace App\Services;

use App\Models\{
    LibraryLoginSessionModel,
    LibraryModel as LM
};
use App\Helpers\ResponseHelper;

class LibrariesService
{
    protected LM $libraryModel;
    protected  LibraryLoginSessionModel $libraryLoginSessionModel;
    public function __construct()
    {
        $this->libraryModel = new LM();
        $this->libraryLoginSessionModel = new LibraryLoginSessionModel();
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

    public function sessionListByLibraryId(string $libraryId, ?array $getRequestData)
    {
        $sessionData = $this->libraryLoginSessionModel->sessionListByLibraryId($libraryId, $getRequestData);


        $result = array_map(function ($s) {
            $s['login_session_id'] = $s['uid'];
            $s['login_details'] = json_decode($s['login_details']);
            return $s;
        }, $sessionData['loginSessions']);



        return ResponseHelper::success(
            HTTP_OK,
            'Login session list ',
            [
                'loginSessionsList' => $result,
                'pagination' => $sessionData['pagination']
            ]
        );
    }
}
