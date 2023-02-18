<?php

namespace PerfectApp\Http;

class Cookie
{
    public function get(string $key)
    {
        return $_COOKIE[$key] ?? null;
    }

    public function set(
        string $key,
        $value,
        int $expire = 0,
        string $path = '',
        string $domain = '',
        bool $secure = false,
        bool $httponly = false
    ): void {
        setcookie($key, $value, $expire, $path, $domain, $secure, $httponly);
        $_COOKIE[$key] = $value;
    }

    public function delete(
        string $key,
        string $path = '',
        string $domain = ''
    ): void {
        setcookie($key, null, time() - 3600, $path, $domain);
        unset($_COOKIE[$key]);
    }
}
