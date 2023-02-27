<?php declare(strict_types=1);

namespace Unit\Database;

use Codeception\Test\Unit;
use PDO;
use PerfectApp\Database\Connection;

class ConnectionTest extends Unit
{
    private array $config = [
        'host' => 'localhost',
        'dbname' => 'perfect-app-starter',
        'charset' => 'utf8',
        'username' => 'root',
        'password' => '',
        'options' => [],
    ];

    public function testConnect(): void
    {
        $connection = new Connection();
        $pdo = $connection->connect($this->config);
        $this->assertInstanceOf(PDO::class, $pdo);
    }
}
