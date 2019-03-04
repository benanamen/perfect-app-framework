<?php declare(strict_types=1);

namespace PerfectApp\Database;

/**
 * Class Database
 * @package PerfectApp\Database
 */
class Database extends \PDO
{
    /**
     * Database constructor.
     * @param array $config
     * @param array $options
     */
    public function __construct(array $config, array $options = array())
    {
        parent::__construct($config['db_type'] . ':host=' . $config['db_host'] . ';dbname=' . $config['db_name'], $config['db_username'], $config['db_password'], $options);
    }
}
