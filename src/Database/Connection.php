<?php declare(strict_types=1);

namespace PerfectApp\Database;

use PDO;

class Connection
{
    final public function connect(array $config): PDO
    {
        $dsn = "mysql:host={$config['host']};dbname={$config['dbname']};charset={$config['charset']}";
        return new PDO($dsn, $config['username'], $config['password'], $config['options']);
    }
}
