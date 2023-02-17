<?php

namespace PerfectApp\Http;

class Request
{
    public function get(string $key)
    {
        return $_REQUEST[$key] ?? null;
    }

    public function has(string $key): bool
    {
        return isset($_REQUEST[$key]);
    }
}
