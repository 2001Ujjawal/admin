<?php

namespace App\Services;

use CodeIgniter\Session\Session;

class SessionService
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

    public function set(array $data): void
    {
        $this->session->set($data);
    }

    public function get(?string $key = null)
    {
        return $key
            ? $this->session->get($key)
            : $this->session->get();
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
