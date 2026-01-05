<?php

namespace App\Services;

use App\Models\ApiKeyModel;

class ApiKeyService
{
    protected  ApiKeyModel  $apiKeyModel;

    public function __construct()
    {
        $this->apiKeyModel = new ApiKeyModel();
    }

    public function generateApiKey($userId, $creatorId = null, $creatorType = null, $userType = null)
    {
        $apiKeyData = $this->generatePrefixApiKey();
        $apiKey = $apiKeyData['api_key'];
        $prefix = $apiKeyData['prefix'];
        $hashedKey = $this->hashApiKeyBcrypt($apiKey);
        $expiresAt = date('Y-m-d H:i:s', strtotime('+30 days'));
        $insertApiKey = [
            'uid'        => uniqid('API_KEY_'),
            'user_id'    => $userId,
            'user_type'  => $userType,
            'creator_id' => $creatorId,
            'creator_type' => $creatorType,
            'prefix'     => $prefix,
            'hash'       => $hashedKey,
            'expires_at' => $expiresAt
        ];
        $this->apiKeyModel->insert($insertApiKey);
        return $apiKey;
    }
    /**
     * Validate the provided API key.
     * @param string $apiKey The API key to validate.
     * @return bool True if valid, false otherwise.
     */
    public function isValidApiKey($apiKey)
    {
        
        if (empty($apiKey)) {
            return false;
        }
        $parts  = explode('.', $apiKey, 2);
        
        $keyId  = $parts[0] ?? null;
        $secret = $parts[1] ?? null;
        if (!$keyId || !$secret) {
            return false;
        }
        $record = $this->apiKeyModel
            ->where('prefix', $keyId)
            ->where('expires_at >', date('Y-m-d H:i:s'))
            ->first();
       
        if (!$record) {
            return false;
        }
        if (password_verify($apiKey, $record['hash'])) {
            return true;
        }

        return false;
    }

    public function isValidApiKeyOld($apiKey)
    {
        if (!$this->apiKeyModel) {
            log_message('error', 'ApiKeyModel is not initialized in ApiKeyService.');
            return false;
        }
        $currentDateTime = date('Y-m-d H:i:s');
        $storedApiKeys = $this->apiKeyModel->where('expires_at >', $currentDateTime)->findAll();
        if (empty($storedApiKeys)) {
            return false;
        }
        foreach ($storedApiKeys as $storedKey) {
            if (!isset($storedKey['hash'])) {
                log_message('error', 'Missing hash in API key record.');
                continue;
            }
            if (password_verify($apiKey, $storedKey['hash'])) {
                return true;
            }
        }

        return false;
    }

    private function generatePrefixApiKey($prefixLength = 5, $keyLength = 32)
    {
        $characters = 'ABCDEFGHJKLddMNPQRSTUVWXYZ23456789';
        $prefix = '';

        for ($i = 0; $i < $prefixLength; $i++) {
            $prefix .= $characters[random_int(0, strlen($characters) - 1)];
        }
        $randomKey = bin2hex(random_bytes($keyLength / 2));
        $apiKey = $prefix . '.' . $randomKey;

        return ['api_key' => $apiKey, 'prefix' => $prefix];
    }
    private function hashApiKeyBcrypt($apiKey)
    {
        return password_hash($apiKey, PASSWORD_BCRYPT);
    }
}
