<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class CorsFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // echo "before cors filter";die; 
        //prt("Before CORS Filter");
        $response = service('response');
        $origin = $request->getHeaderLine('Origin');

        $allowedOrigins = [
            'http://192.168.0.31:5173',
            'http://localhost:5173'
        ];
        // prt($allowedOrigins);
        log_message('debug', "CORS Filter: Origin = $origin | Method = " . $request->getMethod());

        if (in_array($origin, $allowedOrigins)) {
            $response->setHeader('Access-Control-Allow-Origin', $origin);
            $response->setHeader('Access-Control-Allow-Credentials', 'true');
            $response->setHeader('Access-Control-Allow-Headers', 'Origin, Content-Type, Accept, Authorization, device_type,device_id,platform');
            $response->setHeader('Access-Control-Allow-Methods', 'GET, POST, OPTIONS, PUT, PATCH, DELETE');
        }

        if ($request->getMethod() === 'OPTIONS') {
            return $response->setStatusCode(200);
        }


        return null;
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        //prt("After CORS Filter");
        return $response;
    }
}
