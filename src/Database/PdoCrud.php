<?php declare(strict_types=1);

namespace PerfectApp\Database;

use PDO;

/**
 * Class PdoCrud - Originally QueryBuilder
 * @package PerfectApp\Database
 */
class PdoCrud
{
    /**
     * @var PDO
     */
    private $pdo;

    /**
     * PdoCrud constructor.
     * @param PDO $pdo
     */
    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    /**
     * @param string $table
     * @param string $primaryKey
     * @param $id
     * @return object
     */
    final public function findById(string $table, string $primaryKey, string $id): object
    {
        $sql = "SELECT * FROM {$table} WHERE {$primaryKey} = :id";
        $parameters = ['id' => $id];
        return $this->prepareExecuteQuery($sql, $parameters);
    }

    /**
     * @param string $sql
     * @param array $parameters
     * @return object
     */
    final public function prepareExecuteQuery(string $sql, array $parameters = []): object
    {
        $query = $this->pdo->prepare($sql);
        $query->execute($parameters);
        return $query;
    }

    /**
     * @param string $sql
     * @return object
     */
    final public function pdoQuery(string $sql): object
    {
        return $this->pdo->query($sql);
    }

    /**
     * @param string $table
     * @param array $parameters
     * @return bool
     */
    final public function insert(string $table, array $parameters): bool
    {
        $sql = sprintf('INSERT into %s (%s) VALUES (%s)', $table, implode(', ', array_keys($parameters)), ':' . implode(', :', array_keys($parameters)));

        //Alternate
        /*$parameters = array_map(function ($parameters) {
            return ":$parameters";
        }, array_keys($parameters));*/

        $statement = $this->pdo->prepare($sql);
        return $statement->execute($parameters);
    }

    /**
     * @param string $table
     * @param string $primaryKey
     * @param array $fields
     * @return object
     */
    final public function update(string $table, string $primaryKey, array $fields): object
    {
        $params = [];
        $values = [];

        foreach ($fields as $key => $val)
        {
            if ($key !== 'id')
            {
                $values[] = sprintf('`%s` = :%s', $key, $key);
            }
            $params[$key] = $val;
        }
        $sql = sprintf('UPDATE %s SET', $table);
        $sql .= sprintf(' %s WHERE %s', implode(', ', $values), "$primaryKey =:id");
        return $this->prepareExecuteQuery($sql, $params);
    }

    /**
     * @param string $table
     * @param string $primaryKey
     * @param string $id
     * @return int
     */
    final public function delete(string $table, string $primaryKey, string $id): int
    {
        $parameters = [':id' => $id];
        $sql = "DELETE FROM {$table} WHERE {$primaryKey} = :id";
        $del = $this->prepareExecuteQuery($sql, $parameters);
        return $del->rowCount();
    }
}
