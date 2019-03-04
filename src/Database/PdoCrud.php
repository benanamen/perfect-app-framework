<?php declare(strict_types=1);

namespace PerfectApp\Database;


/**
 * Class PdoCrud
 * @packagePerfectApp
 */
class PdoCrud
{
    /**
     * @var \PDO
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
     * DatabaseTable constructor.
     *
     * @param \PDO $pdo
     * @param string $table
     * @param string $primaryKey
     * @param string $className
     * @param array $constructorArgs
     */
    public function __construct(\PDO $pdo, string $table, string $primaryKey, string $className = '\stdClass', array $constructorArgs = [])
    {
        $this->pdo = $pdo;
        $this->table = $table;
        $this->primaryKey = $primaryKey;
        $this->className = $className;
        $this->constructorArgs = $constructorArgs;
    }

    /**
     * @param $value
     * @return mixed
     */
    public function findById($value)
    {
        $query = 'SELECT * FROM `' . $this->table . '` WHERE `' . $this->primaryKey . '` = :value';
        $parameters = ['value' => $value];
        $query = $this->query($query, $parameters);
        return $query->fetchObject($this->className, $this->constructorArgs);
    }

    /**
     * @param $sql
     * @param array $parameters
     * @return bool|\PDOStatement
     */
    public function query($sql, $parameters = [])
    {
        $query = $this->pdo->prepare($sql);
        $query->execute($parameters);
        return $query;
    }

    /**
     * @param $sql
     * @return \PDOStatement
     */
    public function pdoQuery($sql)
    {
        return $this->pdo->query($sql);
    }

    /**
     * @param $fields
     */
    public function insert($fields)
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

        $this->query($query, $fields);
    }

    /**
     * @param $fields
     * @return mixed
     */
    private function processDates($fields)
    {
        foreach ($fields as $key => $value)
        {
            if ($value instanceof \DateTime)
            {
                $fields[$key] = $value->format('Y-m-d');
            }
        }
        return $fields;
    }

    /**
     * @param $fields
     */
    public function updateORIG($fields)
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
        $this->query($query, $fields);
    }

    public function update($fields)
    {
        // KR From https://phpdelusions.net/pdo/sql_injection_example
        //$params = [];
        $setStr = "";
        $allowed = ["first_name", "last_name"];
        foreach ($allowed as $key)
        {
            if (isset($fields[$key]) && $key != "id")
            {
                $setStr .= "`" . str_replace("`", "``", $key) . "` = :" . $key . ",";
                $params[$key] = $fields[$key];
            }
        }
        $setStr = rtrim($setStr, ",");
        $params['id'] = $fields['id'];

        //var_dump($params);
        //var_dump($setStr);
        $this->pdo->prepare("UPDATE {$this->table} SET $setStr WHERE {$this->primaryKey} = :id")->execute($params);
    }

    /**
     * @param $id
     */
    public function delete($id)
    {
        $parameters = [':id' => $id];
        $this->query('DELETE FROM `' . $this->table . '` WHERE `' . $this->primaryKey . '` = :id', $parameters);
    }
}
