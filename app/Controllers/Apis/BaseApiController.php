<?php

namespace App\Controllers\Apis;

use CodeIgniter\RESTful\ResourceController;

class BaseApiController extends ResourceController
{
    protected $format = 'json';

    protected function success($message, $data = [], $code = 200)
    {
        return $this->respond([
            'status'  => true,
            'message' => $message,
            'data'    => $data
        ], $code);
    }

    protected function error($message, $code = 400, $errors = [])
    {
        return $this->respond([
            'status'  => false,
            'message' => $message,
            'errors'  => $errors
        ], $code);
    }

    protected function sendApiResponse($resp)
    {
        $response = [
            'success'    => $resp['success'] ?? false,
            'httpStatus' => $resp['httpStatus'] ?? 500,
            'message'    => $resp['message'] ?? '',
            'errors'     => $resp['errors'] ?? null,
            'data'       => $resp['data'] ?? null,
        ];

        if ($resp['success']) {
            unset($response['errors']);
        }

        if (!$resp['success']) {
            unset($response['data']);
        }

        return $this->respond($response, $resp['httpStatus'] ?? 500);
    }
}