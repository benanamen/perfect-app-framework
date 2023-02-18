<?php

namespace PerfectApp\Session;

class Session
{
    private array $sessionData;

    public function __construct(array $sessionData = null)
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $var               = $sessionData ?? $_SESSION;
        $this->sessionData = &$var;
    }

    public function get(string $key)
    {
        return $this->sessionData[$key] ?? null;
    }

    public function set(string $key, $value): void
    {
        $this->sessionData[$key] = $value;
    }

    public function delete(string $key): void
    {
        unset($this->sessionData[$key]);
    }
}
