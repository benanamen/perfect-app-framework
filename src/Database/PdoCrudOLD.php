<?php declare(strict_types=1);

namespace PerfectApp\Database;

use DateTime;
use PDO;
use stdClass;

/**
 * Class PdoCrud
 * @packagePerfectApp
 */
class PdoCrudOLD
{
    /**
     * @var PDO
     */
    private $pdo;

    /**
     * @var string
     */
    private $table;

    /**
     * @var string
     */
    private $primaryKey;

    /* @var string
     */
    private $className;

    /**
     * @var array
     */
    private $constructorArgs;

    /**
     * PdoCrud constructor.
     * @param PDO $pdo
     * @param string|null $table
     * @param string|null $primaryKey
     * @param string $className
     * @param array $constructorArgs
     */
    public function __construct(PDO $pdo, string $table = null, string $primaryKey = null, string $className = stdClass::class, array $constructorArgs = [])
    {
        $this->pdo = $pdo;
        $this->table = $table;
        $this->primaryKey = $primaryKey;
        $this->className = $className;
        $this->constructorArgs = $constructorArgs;
    }

    /**
     * @param string $value
     * @return object
     */
    // TODO: Why is this returning object?
    final public function findById(string $value): object
    {
        $sql = "SELECT * FROM {$this->table} WHERE {$this->primaryKey} = :value";
        $parameters = ['value' => $value];
        $query = $this->prepareExecuteQuery($sql, $parameters);
        return $query->fetchObject($this->className, $this->constructorArgs);
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
     * @param array $fields
     * @return object
     */
    final public function insert(array $fields): object
    {
        $query = "INSERT INTO {$this->table} (";
        foreach ($fields as $key => $value)
        {
            $query .= "$key,";
        }
        $query = rtrim($query, ',');
        $query .= ') VALUES (';
        foreach ($fields as $key => $value)
        {
            $query .= ':' . $key . ',';
        }
        $query = rtrim($query, ',');
        $query .= ')';
        $fields = $this->processDates($fields);
        return $this->prepareExecuteQuery($query, $fields);
    }

    /**
     * @param array $fields
     * @return array
     */
    private function processDates(array $fields): array
    {
        foreach ($fields as $key => $value)
        {
            if ($value instanceof DateTime)
            {
                $fields[$key] = $value->format('Y-m-d');
            }
        }
        return $fields;
    }

    /**
     * @param array $fields
     */
    final public function updateORIG(array $fields): void
    {
        $id = $fields['id'];
        unset($fields['id']);

        $query = ' UPDATE `' . $this->table . '` SET ';

        foreach ($fields as $key => $value)
        {
            $query .= '`' . $key . '` = :' . $key . ',';
        }

        $query = rtrim($query, ',');
        $query .= ' WHERE `' . $this->primaryKey . '` = :primaryKey';

        $fields['primaryKey'] = $id;
        $fields = $this->processDates($fields);
        $this->prepareExecuteQuery($query, $fields);
    }

    /**
     * From https://phpdelusions.net/pdo/sql_injection_example
     *
     * @param array $fields
     * @return object
     */
    final public function update(array $fields): object
    {
        $params = [];
        $setStr = '';
        foreach ($fields as $key => $value)
        {
            if ($key !== 'id')
            {
                $setStr .= '`' . str_replace('`', '``', $key) . '` = :' . $key . ',';
            }
            $params[$key] = $value;
        }
        $setStr = rtrim($setStr, ',');
        $sql = "UPDATE {$this->table} SET $setStr WHERE {$this->primaryKey} = :id";
        return $this->prepareExecuteQuery($sql, $params);
    }

    /**
     * @param string $id
     * @return object
     */
    final public function delete(string $id): object
    {
        $parameters = [':id' => $id];
        $sql = "DELETE FROM {$this->table} WHERE {$this->primaryKey} = :id";
        return $this->prepareExecuteQuery($sql, $parameters);
    }
}
