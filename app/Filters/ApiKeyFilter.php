<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;
use Config\Services;
use App\Models\ApiKeyModel;
use App\Services\ApiKeyService;

class ApiKeyFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $apiKeyService = new ApiKeyService();
        $apiKeyHeader = $request->getHeaderLine('X-API-KEY');
        

        if (!$apiKeyHeader || !$apiKeyService->isValidApiKey($apiKeyHeader)) {
            return Services::response()
                ->setJSON([
                    'status'     => 'failed',
                    'statusCode' => ResponseInterface::HTTP_UNAUTHORIZED,
                    'message'    => 'Invalid or missing API Key',
                    'errors'     => [],
                    'data'       => []
                ])
                ->setStatusCode(ResponseInterface::HTTP_UNAUTHORIZED);
        }
        return;
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // No post-processing required
    }

    // private function isValidApiKey($apiKey)
    // {
    //     $apiKeyModel = new ApiKeyModel();
    //     $currentDateTime = date('Y-m-d H:i:s');
    //     $storedApiKeys = $apiKeyModel->where('expires_at >', $currentDateTime)->findAll();
    //     foreach ($storedApiKeys as $storedKey) {
    //         if (password_verify($apiKey, $storedKey['hash'])) {
    //             return true;
    //         }
    //     }
    //     return false;
    // }
}
