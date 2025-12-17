<?php

namespace App\Helpers;

class SessionManageHelper
{
    protected $session;

    public function __construct()
    {
        $this->session = session();
    }
    public static function errorMessageShow(string $message)
    {
        $errorMessage = $this->session->setFlashdata('error', $message);
        return $errorMessage; 
    }
}