<?php

namespace PerfectApp\Http;

class PostRequest
{
    public function get(string $key)
    {
        return $_POST[$key] ?? null;
    }

    public function has(string $key): bool
    {
        return isset($_POST[$key]);
    }
}
