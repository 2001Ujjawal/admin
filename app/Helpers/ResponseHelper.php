<?php
namespace App\Helpers;
class ResponseHelper
{
    public static function success($success, $message, ?array $data = null, $code = 200): object
    {
        return (object) [
            'success' => $success,
            'httpStatus' => $code,
            'message' => $message,
            'data' => $data
        ];
    }

    public static function error($success, $message, $code = 400, $errors = null): object
    {
        return (object) [
            'success' => $success,
            'httpStatus' => $code,
            'message' => $message,
            'errors' => $errors
        ];
    }
}