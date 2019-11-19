<?php declare(strict_types=1);

class DatabaseTest extends PHPUnit\Framework\TestCase
{

    final public function testConnection(): void
    {
        $host = 'localhost';
        $db = 'perfect_app';
        $user = 'root';
        $pass = '';
        $charset = 'utf8mb4';

        $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
        $options = [
              PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            , PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
            , PDO::ATTR_EMULATE_PREPARES => false
        ];

        $pdo = new PDO($dsn, $user, $pass, $options);
        $this->assertIsObject($pdo);
    }
}
