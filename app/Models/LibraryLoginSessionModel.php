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
}
