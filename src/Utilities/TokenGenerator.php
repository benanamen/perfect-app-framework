<?php declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: Owner
 * Date: 7/9/2020
 * Time: 12:15 PM
 */

namespace PerfectApp\Utilities;


class TokenGenerator
{
    /**
     * @return array
     * @throws \Exception
     */
    final public function generateToken(): array
    {
        $raw_token = random_bytes(16);
        $encoded_token = bin2hex($raw_token);
        $token_hash = hash('sha256', $raw_token);
        return array($encoded_token, $token_hash);
    }
}
