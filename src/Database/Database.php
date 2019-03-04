<?php declare(strict_types=1);

namespace PerfectApp\Database;

use PDO;

/**
 * Class Database
 * @package PerfectApp\Database
 */
class Database extends PDO
{
    /**
     * Database constructor.
     * @param $dsn
     * @param null $username
     * @param null $password
     * @param array $options
     */
    public function __construct($dsn, $username = NULL, $password = NULL, $options = [])
    {
        parent::__construct($dsn, $username, $password, $options);
    }
}
