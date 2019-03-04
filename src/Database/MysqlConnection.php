<?php declare(strict_types=1);

namespace PerfectApp\Database;

use PDO;

/**
 * Class MysqlConnection
 * @package PerfectApp
 */
class MysqlConnection implements ConnectionInterface
{
    /**
     * @return mixed|PDO
     */
    public function connect()
    {
        $dsn = DB_TYPE . ":host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=" . DB_CHARSET;
        $opt = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            , PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
            , PDO::ATTR_EMULATE_PREPARES => false];

        return new PDO($dsn, DB_USER, DB_PASSWORD, $opt);
    }
}
