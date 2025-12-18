<?php

namespace App\Interfaces;

interface SessionServiceInterface
{
    public  function error(string $message): void;
    public  function success(string $message): void;
    public function set(string $key, $value): void;
    public function get(string $key);
    public function destroy(): void;
}
