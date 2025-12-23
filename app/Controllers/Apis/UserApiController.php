<?php

namespace App\Controllers\Apis;

use App\Controllers\Apis\BaseApiController;

class UserApiController extends BaseApiController
{

    public function userList(string $userId)
    {
        // $jsonRequest = $this->request->getJSON(true);

        // $name = $jsonRequest['name'];
       

        // if (empty($name)) {
        //     $response = $this->error(false, 'validation failed', 400, null);
        // }
        $response = $this->success(true, 'Get user list success fully', null,  200);
        return $this->sendApiResponse($response);
    }
}
