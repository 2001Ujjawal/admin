<?php


namespace App\Models;

use CodeIgniter\Model;

class LibraryModel extends Model
{

    protected $table = 'library';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'uid',
        'name',
        'email',
        'phone_no',
        'type',
        'reg_no',
        'address',
        'created_at',
        'created_by'
    ];

    protected $validationRules = [
        'name' => 'required|min_length[3]|max_length[30]|alpha_numeric_space',
        'email' => 'required|valid_email|is_unique[library.email]',
        'phone_no' => 'required|numeric|min_length[10]|max_length[15]|is_unique[library.phone_no]',
        'reg_no' => 'required|alpha_numeric|max_length[50]|is_unique[library.reg_no]',
        'type' => 'required',
        'address' => 'required'
    ];

    protected $validationMessages = [
        'email' => [
            'is_unique' => 'Sorry. That email has already been taken.',
        ],
        'phone_no' => [
            'is_unique' => 'Phone number already exists.',
        ],
        'reg_no' => [
            'is_unique' => 'Registration number already exists.',
        ],
    ];

}