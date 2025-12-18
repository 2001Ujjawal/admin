<?php

namespace App\Services;

use CodeIgniter\Session\Session;
use App\Interfaces\SessionServiceInterface;

class SessionService // implements SessionServiceInterface
{
    protected Session $session;

    public function __construct()
    {
        $this->session = session();
    }

    public function error(string $message): void
    {
        $this->session->setFlashdata('error', $message);
    }

    public function success(string $message): void
    {
        $this->session->setFlashdata('success', $message);
    }
    public function set($value): void
    {
        //string $key $key, , 
        $finalValue = [
            'sessionUserData' => $value,
        ];
        $this->session->set($finalValue);
    }

    public function get(?string $key = null)
    {
        return $key
            ? $this->session->get($key)
            : $this->session->get('sessionUserData');
    }

    public function remove(array $keys): void
    {
        $this->session->remove($keys);
    }

    public function destroy(): void
    {
        $this->session->destroy();
    }
}
