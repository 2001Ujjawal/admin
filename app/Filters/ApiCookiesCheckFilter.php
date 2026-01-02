<?php

namespace App\Filters;


use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class ApiCookiesCheckFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $jwt = $request->getCookie('jwt_token');

        // Or use your constant TOKEN_NAME_JWT
        if (empty($jwt)) {
            return service('response')
                ->setStatusCode(401)
                ->setJSON([
                    'success' => false,
                    "httpStatus" => 401,
                    "messsage" => "Jwt Cookie Token Expired",
                    'errors'  => [
                        'cookieToken' => 'Unauthorized access: Token missing'
                    ]

                ]);
        }

        try {
            $secret = getenv('JWT_PRIVATE_KEY') ?: 'your_jwt_secret_key';

            $decoded = JWT::decode($jwt, new Key($secret, 'HS256'));
            $decodeTokenValue = $decoded->data ?? null;
            
        } catch (\Exception $e) {
            return service('response')
                ->setStatusCode(401)
                ->setJSON([
                    'success' => false,
                    "httpStatus" => 500,
                    "messsage" => "Jwt Cookie Token Expired ",
                    'errors'  => [
                        'cookieToken' => 'Unauthorized access: Token missing',
                        'e' => $e
                    ]

                ]);
        }

        return; // Continue the request
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // No after-processing needed
    }
}
