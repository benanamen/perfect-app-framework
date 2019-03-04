<?php declare(strict_types=1);

namespace PerfectApp\Logging;

use \PDO;

/** Test - Usage
require('../config.php');
$test = new SQLLoginAttemptsLog($pdo);
$test->logFailedAttempt('hacker');
$test->logSuccessfulAttempt('gooduser');
*/

/**
 * Reference https://forums.phpfreaks.com/topic/302286-oop-code-review/?hl=%2Boop#entry1538069
 */
class SQLLoginAttemptsLog implements LoginLogger
{
    /**
     * @var PDO the connection to the underlying database
     */
    protected $database;

    /**
     * Connection to underlying database
     * @param PDO $database
     */
    public function __construct(PDO $database)
    {
        $this->database = $database;
    }

    /**
     * Log failed login attempt
     * @param string $username
     */
    public function logFailedAttempt($username)
    {
        $this->logAttempt($username, false);
    }

    /**
     * Log successful login attempt
     * @param string $username
     */
    public function logSuccessfulAttempt($username)
    {
        $this->logAttempt($username, true);
    }

    /**
     * Insert login attempt status
     * @param string  $username
     * @param boolean $successful
     */
    protected function logAttempt($username, $successful)
    {
        $attemptStmt = $this->database->prepare('
            INSERT INTO
              user_login (login_status, login_ip, login_username, login_datetime)
            VALUES
              (?, INET_ATON(?), ?, NOW())
        ');
        $attemptStmt->execute([($successful ? 1 : 0), $_SERVER['REMOTE_ADDR'], $username]);
    }
}
