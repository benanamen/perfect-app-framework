<?php declare(strict_types=1);

namespace PerfectApp\Database;


class Database extends \PDO
{
    public function __construct(array $config, array $options = array())
    {
        try {
            parent::__construct($config['db_type'] . ':host=' . $config['db_host'] . ';dbname=' . $config['db_name'], $config['db_username'], $config['db_password'], $options);
        } catch (\PDOException $e) {
            die('ERROR: ' . $e->getMessage());
        }
    }
}