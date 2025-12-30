<?php

namespace App\Models;

use CodeIgniter\Model;

class LibraryModel extends Model
{
    protected $table = 'library';
    protected $primaryKey   = 'id';
    protected $allowedFields  = [
        'uid',
        'name',
        'email',
        'address',
        'password',
        'phone_no',
        'created_by',
        'created_at',
        'type',
        'reg_no',
        'library_user_type'
    ];


    protected $validationRules = [
        'name' => 'required',
        'phone_no' => 'required',
        'reg_no'    => 'required',
        'email'        => 'required|max_length[254]|valid_email|is_unique[library.email]',
    ];
    protected $validationMessages = [
        'email' => [
            'is_unique' => 'Sorry. That email has already been taken. Please choose another.',
        ],
    ];

    public function checkLibraryExits(string $email): ?object
    {
        return $this->where('email', $email)->get()->getRow();
    }
}
