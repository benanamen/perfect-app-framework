<?php declare(strict_types=1);

namespace PerfectApp\Utilities;

use Exception;

class TokenGenerator
{
    /**
     * @return array
     * @throws Exception
     */
    final public function generateToken(): array
    {
        $raw_token = random_bytes(16);
        $encoded_token = bin2hex($raw_token);
        $token_hash = hash('sha256', $raw_token);
        return [$encoded_token, $token_hash];
    }
}
