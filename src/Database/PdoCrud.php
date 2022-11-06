<?php declare(strict_types=1);

namespace PerfectApp\Database;

use PDO;

/**
 *
 */
class PdoCrud
{
    /**
     * @var PDO
     */
    private PDO $pdo;

    /**
     * @param  PDO  $pdo
     */
    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    /**
     * @param  string  $table
     * @param  string  $primaryKey
     * @param  string  $id
     *
     * @return array|bool
     */
    final public function findById(string $table, string $primaryKey, string $id): array|bool
    {
        $sql = "SELECT * FROM $table WHERE $primaryKey = :id";
        return $this->prepareExecuteQuery($sql, [$id])->fetch();
    }

    /**
     * @param  string  $sql
     * @param  array  $parameters
     *
     * @return object
     */
    final public function prepareExecuteQuery(string $sql, array $parameters = []): object
    {
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($parameters);
        return $stmt;
    }

    /**
     * @param  string  $sql
     *
     * @return object
     */
    final public function pdoQuery(string $sql): object
    {
        return $this->pdo->query($sql);
    }

    /**
     * @param  string  $table
     * @param  array  $parameters
     *
     * @return object
     */
    final public function insert(string $table, array $parameters): object
    {
        unset($parameters['id']);
        $keys = implode('`, `', array_keys($parameters));
        $values = implode(', :', array_keys($parameters));
        return $this->prepareExecuteQuery("INSERT INTO $table (`$keys`) VALUES (:$values)", $parameters);
    }

    /**
     * @param  string  $table
     * @param  string  $primaryKey
     * @param  array  $fields
     *
     * @return object
     */
    final public function update(string $table, string $primaryKey, array $fields): object
    {
        $params = [];
        $values = [];

        foreach ($fields as $key => $val) {
            if ($key !== 'id') {
                $values[] = sprintf('`%s` = :%s', $key, $key);
            }
            $params[$key] = $val;
        }
        $sql = sprintf('UPDATE %s SET', $table);
        $sql .= sprintf(' %s WHERE %s', implode(', ', $values), "$primaryKey =:id");
        return $this->prepareExecuteQuery($sql, $params);
    }

    /**
     * @param  string  $table
     * @param  string  $primaryKey
     * @param  string  $id
     *
     * @return int
     */
    final public function delete(string $table, string $primaryKey, string $id): int
    {
        $sql = "DELETE FROM $table WHERE $primaryKey = :id";
        $del = $this->prepareExecuteQuery($sql, [$id]);
        return $del->rowCount();
    }
}
