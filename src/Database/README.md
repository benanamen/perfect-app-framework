THIS IS OUTDATED

Database Usage:

```php
$host = '127.0.0.1';
$db = 'test';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, PDO::ATTR_EMULATE_PREPARES => false,];

$pdo = new PDO($dsn, $user, $pass, $options);

$sql = 'SELECT * FROM user';
$stmt = $pdo->query($sql);

foreach ($stmt as $row)
{
    echo '<pre>', print_r($row, true), '<pre>';
}
```