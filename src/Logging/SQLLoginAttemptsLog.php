<?php declare(strict_types=1);

namespace PerfectApp\Logging;

use PDO;

/** Test - Usage
 * require('../config.php');
 * $test = new SQLLoginAttemptsLog($db);
 * $test->logFailedAttempt('hacker');
 * $test->logSuccessfulAttempt('gooduser');
 */

/**
 * Reference https://forums.phpfreaks.com/topic/302286-oop-code-review/?hl=%2Boop#entry1538069
 */
class SQLLoginAttemptsLog implements LoginLogger
{
    /**
     * @var PDO the connection to the underlying Database
     */
    protected $database;

    /**
     * Connection to underlying Database
     * @param PDO $database
     */
    public function __construct(PDO $database)
    {
        $this->database = $database;
    }

    /**
     * Log failed login attempt
     * @param string $username
     * @return bool
     */
    final public function logFailedAttempt(string $username): bool
    {
        return $this->logAttempt($username, false);
    }

    /**
     * @param string $username
     * @return bool
     */
    final public function logSuccessfulAttempt(string $username): bool
    {
        return $this->logAttempt($username, true);
    }

    /**
     * @param string $username
     * @param bool $successful
     * @return bool
     */
    private function logAttempt(string $username, bool $successful): bool
    {
        $attemptStmt = $this->database->prepare('
            INSERT INTO
              user_login (login_status, login_ip, login_username, login_datetime)
            VALUES
              (?, INET_ATON(?), ?, NOW())
        ');
        return $attemptStmt->execute([($successful ? 1 : 0), $_SERVER['REMOTE_ADDR'], $username]);
    }
}
