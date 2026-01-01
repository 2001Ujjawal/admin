<?php

namespace App\Helpers;

class ResponseHelper
{
    public static function success(
        int $code = 200,
        string $message,
        ?array $data = null
    ): object {
        return (object) [
            'success'  => true,
            'httpStatus' => $code,
            'message' => $message,
            'data'    => $data
        ];
    }

    public static function error(
        int $code = 400,
        string $message,
        ?array $errors = null
    ): object {
        return (object) [
            'success'  => false,
            'httpStatus' => $code,
            'message' => $message,
            'errors'  => $errors
        ];
    }
}
