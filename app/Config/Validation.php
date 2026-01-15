<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;
use CodeIgniter\Validation\StrictRules\CreditCardRules;
use CodeIgniter\Validation\StrictRules\FileRules;
use CodeIgniter\Validation\StrictRules\FormatRules;
use CodeIgniter\Validation\StrictRules\Rules;
use Illuminate\Support\Arr;

class Validation extends BaseConfig
{
    // --------------------------------------------------------------------
    // Setup
    // --------------------------------------------------------------------

    /**
     * Stores the classes that contain the
     * rules that are available.
     *
     * @var list<string>
     */
    public array $ruleSets = [
        Rules::class,
        FormatRules::class,
        FileRules::class,
        CreditCardRules::class,
    ];

    /**
     * Specifies the views that are used to display the
     * errors.
     *
     * @var array<string, string>
     */
    public array $templates = [
        'list'   => 'CodeIgniter\Validation\Views\list',
        'single' => 'CodeIgniter\Validation\Views\single',
    ];

    // --------------------------------------------------------------------
    // Rules
    // --------------------------------------------------------------------

    public array $loginValidationRules = [
        'email' => "required|valid_email",
        'password' => "required"
    ];

    public array $logoutValidationRules = [
        'library_id' => 'required|string',
        'library_login_session_id' => 'required|string',
    ];

    public array $otpSendValidationRules = [
        'email' => 'required|valid_email'
    ];
    public array $otpVerifyValidationRules = [
        'otp' => 'required',
        'system_otp' => 'required',
        'otp_id' => 'required'

    ];

    public array $changePasswordRules = [
        'email' => [
            'rules'  => 'required',
        ],

        'password' => [
            'rules'  => 'required',
            'errors' => [
                'required' => 'Current password is required.',
            ],
        ],

        'new_password' => [
            'rules'  => 'required|min_length[8]|max_length[15]|regex_match[/(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*#?&])/]|matches[password]',
            'errors' => [
                'required'    => 'New password is required.',
                'min_length'  => 'New password must be exactly 8 characters.',
                'max_length'  => 'New password must be exactly 15 characters.',
                'regex_match' => 'Password must contain uppercase, lowercase, number and special character.',
                'matches'     => 'New password must match the current password.',
            ],
        ],
    ];
}
