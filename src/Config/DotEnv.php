<?php

declare(strict_types=1);
//From https://dev.to/fadymr/php-create-your-own-php-dotenv-3k2i
// A different simple implementation https://dev.to/walternascimentobarroso/dotenv-in-php-45mn

namespace PerfectApp\Config;

use InvalidArgumentException;
use RuntimeException;

/**
 * Class DotEnv
 *
 * @package PerfectApp\Config
 */
class DotEnv
{
    /**
     * The directory where the .env file can be located.
     *
     * @var string
     */
    protected string $path;

    /**
     * DotEnv constructor.
     *
     * @param  string  $path
     */
    public function __construct(string $path)
    {
        if (!file_exists($path)) {
            throw new InvalidArgumentException(sprintf('%s does not exist', $path));
        }
        $this->path = $path;
    }

    /**
     *
     */
    public function load(): void
    {
        if (!is_readable($this->path)) {
            throw new RuntimeException(sprintf('%s file is not readable', $this->path));
        }

        $lines = file($this->path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        foreach ($lines as $line) {

            if (str_starts_with(trim($line), '#')) {
                continue;
            }

            list($name, $value) = explode('=', $line, 2);
            $name = trim($name);
            $value = trim($value);

            if (!array_key_exists($name, $_SERVER) && !array_key_exists($name, $_ENV)) {
                putenv(sprintf('%s=%s', $name, $value));
                $_ENV[$name] = $value;
                $_SERVER[$name] = $value;
            }
        }
    }
}
