<?php

namespace PerfectApp\Http;

class Request
{
    private $requestData;

    public function __construct(array $requestData)
    {
        $this->requestData = $requestData;
    }

    public function get(string $key)
    {
        return $this->requestData[$key] ?? null;
    }

    public function has(string $key): bool
    {
        return isset($this->requestData[$key]);
    }
}
