<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class LibraryWebTokenCheckFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $jwt = $request->getCookie('jwt_token');

        // Or use your constant TOKEN_NAME_JWT
        if (empty($jwt)) {
            // $sessionService->error('Token expired ! please login again');
            return redirect()->to('libraries/login');
        }

        try {
            $secret = getenv('JWT_PRIVATE_KEY') ?: 'your_jwt_secret_key';

            $decoded = JWT::decode($jwt, new Key($secret, 'HS256'));
            $decodeTokenValue = $decoded->data ?? null;
        } catch (\Exception $e) {
            return redirect()->to('libraries/login');
        }

        return; // Continue the request
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // No after-processing needed
    }
}
