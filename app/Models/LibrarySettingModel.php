<?php

namespace App\Models;

use CodeIgniter\Model;

class LibrarySettingModel extends Model
{
    protected $table = 'library_setting';
    protected $primaryKey   = 'id';
    protected $allowedFields  = [
        'uid',
        'library_id',
        'is_two_setup_authentication',
        'allow_login_device',
        'created_at',
        'created_by',
        'last_updated_by',
        'last_updated_at',
        'otp_send_type'
    ];

    public function librarySettingDetails(string $libraryUid): ?object
    {
        return $this->where('library_id', $libraryUid)->get()->getRow();
    }
}
