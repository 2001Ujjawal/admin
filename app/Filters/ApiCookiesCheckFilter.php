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
        $jwt = $request->getCookie(getenv('COOKIE_NAME'));

        if (!$jwt) {
            return $this->unauthorized('JWT token missing');
        }

        $secret = getenv('JWT_PRIVATE_KEY') ?: 'your_jwt_secret_key';

        try {
            $decoded = JWT::decode($jwt, new Key($secret, 'HS256'));

            // $request->setGlobal('auth_user', $decoded->data ?? null);

        } catch (\Throwable $e) {

            return $this->unauthorized('Invalid JWT token');
        }
        return;
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // no-op
    }


    protected function unauthorized(string $message)
    {
        return service('response')
            ->setStatusCode(401)
            ->setJSON([
                'success' => false,
                'httpStatus' => 401,
                'message' => $message,
                'errors' => [
                    'auth' => $message
                ]
            ]);
    }
}
