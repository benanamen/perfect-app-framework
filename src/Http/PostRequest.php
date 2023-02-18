<?php

namespace PerfectApp\Http;

class PostRequest
{
    private $postData;

    public function __construct(array $postData)
    {
        $this->postData = $postData;
    }

    public function get(string $key)
    {
        return $this->postData[$key] ?? null;
    }

    public function has(string $key): bool
    {
        return isset($this->postData[$key]);
    }
}
