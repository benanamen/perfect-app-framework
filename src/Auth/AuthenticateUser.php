<?php declare(strict_types=1);

namespace PerfectApp\Auth;

use PDO;
use PerfectApp\Database\PdoCrud;

/**
 * Class AuthenticateUser
 * @package PerfectApp\Auth
 */
class AuthenticateUser
{
    /**
     * @var PdoCrud
     */
    public $pdoCrud;
    /**
     * @var PDO the connection to the underlying database
     */
    protected $pdo;

    /**
     * AuthenticateUser constructor.
     * @param PDO $pdo
     * @param  pdoCrud $pdoCrud
     */
    public function __construct(PDO $pdo, PdoCrud $pdoCrud)
    {
        $this->pdo = $pdo;
        $this->pdoCrud = $pdoCrud;
    }

    /**
     * Checks whether a username/password combination is valid
     * @param $sql string
     * @param $username array
     * @param $password string
     * @return bool|mixed
     */
    public function check($sql, $username, $password)
    {
        $stmt = $this->pdoCrud->query($sql, $username);
        $row = $stmt->fetch();

        if ($row && password_verify($password, $row['password']))
        {
            return $row;
        }
        return false;
    }
}
