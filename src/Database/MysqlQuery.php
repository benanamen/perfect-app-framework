<?php declare(strict_types=1);

namespace PerfectApp\Database;

use PDO;

/**
 * Class MysqlPdoQuery
 * @package PerfectApp
 */
class MysqlQuery
{
    /**
     * @var PDO the connection to the underlying database
     */
    protected $database;

    /**
     * @param PDO $database
     */
    public function __construct(PDO $database)
    {
        $this->database = $database;
    }

    /**
     * @param $sql
     * @return \PDOStatement
     */
    public function pdoQuery($sql)
    {
        return $this->database->query($sql);
    }
}