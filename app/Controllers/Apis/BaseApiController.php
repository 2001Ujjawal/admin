<?php

namespace App\Controllers\Apis;

use CodeIgniter\RESTful\ResourceController;

class BaseApiController extends ResourceController
{
    protected $format = 'json';





    protected function success($success, $message, ?array $data = null, $code = 200) : object
    {
        return (object) [
            'success'  => $success,
            'httpStatus' => $code,
            'message' => $message,
            'data'    => $data
        ];
    }

    protected function error($success, $message, $code = 400, $errors = null) : object
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
}
