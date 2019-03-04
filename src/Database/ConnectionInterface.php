<?php declare(strict_types=1);

namespace PerfectApp\Database;
/**
 * Interface DatabaseConnection
 * @package PerfectApp
 */
interface ConnectionInterface
{
    /**
     * @return mixed
     */
    public function connect();
}
