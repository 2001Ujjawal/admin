<?php

namespace App\Models;

use CodeIgniter\Model;

class OtpModel extends Model
{
    protected $table = 'otp';
    protected $primaryKey   = 'id';
    protected $allowedFields  = [
        'id',
        'uid',
        'user_id',
        'otp_send_type',
        'user_type',
        'value',
        'hash_otp',
        'system_otp',
        'created_at',
        'status',
        'purpose'
    ];


    public function storeOtp(array $otpSaveData): array|bool|string
    {
        $saveOtp = $this->insert($otpSaveData);
        if ($saveOtp === false)  return false;
        return $otpSaveData['uid'];
    }
}
