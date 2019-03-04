<?php

use PerfectApp\Database\MysqlConnection;

class MysqlConnectionTest extends PHPUnit\Framework\TestCase
{

    public function testConnect()
    {
        $pdo = new MysqlConnection();
        $this->assertIsObject($pdo->connect());
    }
}
