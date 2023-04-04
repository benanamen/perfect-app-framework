<?php

namespace PerfectApp\Http;

class Cookie
{
    /**
     * @var array<string, mixed>
     */
    private array $cookie;

    /**
     * Cookie constructor.
     * @param array<string, mixed> $cookie
     */
    public function __construct(array $cookie)
    {
        $this->cookie = $cookie;
    }

    public function get(string $key): ?string
    {
        return $this->cookie[$key] ?? null;
    }

    public function set(
        string $key,
        string $value,
        int $expire = 0,
        string $path = '',
        string $domain = '',
        bool $secure = false,
        bool $httponly = false
    ): void {
        setcookie($key, $value, $expire, $path, $domain, $secure, $httponly);
        $this->cookie[$key] = $value;
    }

    public function delete(
        string $key,
        string $path = '',
        string $domain = ''
    ): void {
        setcookie($key, '', time() - 3600, $path, $domain);
        unset($this->cookie[$key]);
    }
}
