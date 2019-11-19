<?php declare(strict_types=1);

namespace PerfectApp\Logging;

/**
 * A login attempt logger
 *
 * Interface LoginLogger
 * @package PerfectApp\Logger
 */
interface LoginLogger
{
    /**
     * Logs a failed login attempt
     *
     * @param string $username the attempted username to log
     * @return bool
     */
    public function logFailedAttempt(string $username): bool;


    /**
     * Logs a successful login attempt
     *
     * @param string $username the attempted username to log
     * @return bool
     */
    public function logSuccessfulAttempt(string $username): bool;
}
