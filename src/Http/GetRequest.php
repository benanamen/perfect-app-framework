<?php

namespace PerfectApp\Http;

class GetRequest
{
    public function get(string $key)
    {
        return $_GET[$key] ?? null;
    }

    public function has(string $key): bool
    {
        return isset($_GET[$key]);
    }
}
