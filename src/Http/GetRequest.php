<?php

namespace PerfectApp\Http;

class GetRequest
{
    private $getData;

    public function __construct(array $getData)
    {
        $this->getData = $getData;
    }

    public function get(string $key)
    {
        return $this->getData[$key] ?? null;
    }

    public function has(string $key): bool
    {
        return isset($this->getData[$key]);
    }
}
