<?php declare(strict_types=1);

namespace PerfectApp\Database;

use DateTime;
use PDO;
use PDOStatement;

/**
 * Class PdoCrud
 * @packagePerfectApp
 */
class PdoCrud
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
    /**
     * @var string
     */
    private $className;
    /**
     * @var array
     */
    private $constructorArgs;

    /**
     * PdoCrud constructor.
     * @param PDO $pdo
     * @param string $table
     * @param string $primaryKey
     * @param string $className
     * @param array $constructorArgs
     */
    public function __construct(PDO $pdo, string $table, string $primaryKey, string $className = \stdClass::class, array $constructorArgs = [])
    {
        $this->pdo = $pdo;
        $this->table = $table;
        $this->primaryKey = $primaryKey;
        $this->className = $className;
        $this->constructorArgs = $constructorArgs;
    }


    /**
     * @param string $value
     * @return mixed
     */
    final public function findById(string $value)
    {
        $query = 'SELECT * FROM `' . $this->table . '` WHERE `' . $this->primaryKey . '` = :value';
        $parameters = ['value' => $value];
        $query = $this->prepareQuery($query, $parameters);
        return $query->fetchObject($this->className, $this->constructorArgs);
    }

    /**
     * @param string $sql
     * @param array $parameters
     * @return bool|PDOStatement
     */
    final public function prepareQuery(string $sql, array $parameters = [])
    {
        $query = $this->pdo->prepare($sql);
        $query->execute($parameters);
        return $query;
    }

    /**
     * @param string $sql
     * @return false|PDOStatement
     */
    final public function pdoQuery(string $sql)
    {
        return $this->pdo->query($sql);
    }

    /**
     * @param array $fields
     */
    final public function insert(array $fields): void
    {
        $query = 'INSERT INTO `' . $this->table . '` (';

        foreach ($fields as $key => $value)
        {
            $query .= '`' . $key . '`,';
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

        $this->prepareQuery($query, $fields);
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
        $this->prepareQuery($query, $fields);
    }

    /**
     * @param array $fields
     */
    final public function update(array $fields): void
    {
        // KR From https://phpdelusions.net/pdo/sql_injection_example
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
        $this->pdo->prepare("UPDATE {$this->table} SET $setStr WHERE {$this->primaryKey} = :id")->execute($params);
    }

    /**
     * @param string $id
     */
    final public function delete(string $id): void
    {
        $parameters = [':id' => $id];
        $this->prepareQuery('DELETE FROM `' . $this->table . '` WHERE `' . $this->primaryKey . '` = :id', $parameters);
    }
}
