<?php

namespace App\Models;

use CodeIgniter\Model;

class LibraryLoginSessionModel extends Model
{
    protected $table = 'library_login_sessions';
    protected $primaryKey   = 'id';
    protected $allowedFields  = [
        'uid',
        'library_id',
        'email',
        'phone_no',
        'is_login',
        'login_details',
        'created_at',
        'status'
    ];


    public function loginSessionCount(string $libraryId): int
    {
        $countConditions = [
            'library_id' => $libraryId,
            'status'     => STATUS_ACTIVE,
            'is_login'   => 1
        ];
        $countLibraryAllSession = $this->where($countConditions)->countAllResults();
        return $countLibraryAllSession;
    }


    public function logout(array $logoutPayload): bool
    {
        $updateValues = [
            'is_login' => 0
        ];
        $logout = $this->set($updateValues)->where($logoutPayload)->update();

        if (!$logout) {
            return false;
        }
        return true;
    }
}
