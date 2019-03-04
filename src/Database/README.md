USAGE:

```
$config = array(
    'db_type' => 'mysql',
    'db_host' => 'example.com',
    'db_name' => 'exampleDB',
    'db_username' => 'myUsername',
    'db_password' => 'myPassword'
);

$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    , PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    , PDO::ATTR_EMULATE_PREPARES => false];

$pdo = new Database($config, $options);

$sql = 'SELECT * FROM user';
$stmt = $pdo->query($sql);

foreach ($stmt as $row) {
    echo '<pre>', print_r($row, true), '<pre>';
}
```