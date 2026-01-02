<?php

namespace App\Controllers\Apis;

use CodeIgniter\RESTful\ResourceController;
use App\Helpers\{JwtHelper};

class BaseApiController extends ResourceController
{
    protected $format = 'json';

    public function __construct() {}


    protected function success($success, $message, ?array $data = null, $code = 200): object
    {
        return (object) [
            'success'  => $success,
            'httpStatus' => $code,
            'message' => $message,
            'data'    => $data
        ];
    }

    protected function error($success, $message, $code = 400, $errors = null): object
    {
        return (object) [
            'success'  => $success,
            'httpStatus' => $code,
            'message' => $message,
            'errors'  => $errors
        ];
    }

    protected function sendApiResponse(object $resp)
    {

        $response = [
            'success'    => $resp->success ?? false,
            'httpStatus' => $resp->httpStatus ?? 500,
            'message'    => $resp->message ?? '',
            'errors'     => $resp->errors ?? null,
            'data'       => $resp->data ?? null,
        ];

        if ($resp->success) {
            unset($response->errors);
        }

        if (!$resp->success) {
            unset($response->data);
        }

        return $this->respond($response, $resp->httpStatus ?? 500);
    }


    public function getLoggedUserDetails(): ?array
    {
        $request = \Config\Services::request();
        $getCookiesToken = $request->getCookie(getenv('COOKIE_NAME'));
        if (empty($getCookiesToken)) {
            $error = (object) [
                'httpStatus' => 401,
                'message' => 'Not found any token'
            ];
            return $this->sendApiResponse($error);
        }
        $loggedUserValue = JwtHelper::verifyToken($getCookiesToken);
        $result = ['userDetails' => $loggedUserValue->data ?? []];
        return   $result;
    }

    public function loggedUserId(): string
    {
        $loggedUserDetails = $this->getLoggedUserDetails();
        return $loggedUserDetails['userDetails']->userId;
    }
}
