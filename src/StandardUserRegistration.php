<?php declare(strict_types=1);


namespace PerfectApp;

use PDO;
use PerfectApp\Mail\MailSubmissionAgent;


/**
 * Class StandardUserRegistration
 * @package PerfectApp
 */
class StandardUserRegistration implements UserRegistration
{
    /**
     * @var PDO the connection to the underlying database
     */
    protected $pdo;

    /**
     * @var MailSubmissionAgent
     */
    private $mailSubmissionAgent;


    /**
     * StandardUserRegistration constructor.
     * @param MailSubmissionAgent $mailSubmissionAgent
     * @param PDO $pdo
     */
    public function __construct(MailSubmissionAgent $mailSubmissionAgent, PDO $pdo)
    {
        $this->mailSubmissionAgent = $mailSubmissionAgent;
        $this->pdo = $pdo;
    }


    /**
     * @param $firstName
     * @param $lastName
     * @param $to
     * @param $username
     * @param $password
     * @return mixed|void
     */
    public function register($firstName, $lastName, $to, $username, $password)
    {
        $raw_token = openssl_random_pseudo_bytes(16);
        $encoded_token = bin2hex($raw_token);
        $token_hash = hash('sha256', $raw_token);

        try
        {
            $sql = '
            INSERT INTO
              users (
                first_name
              , last_name
              , email
              , username
              , password
              , verify_email_hash
              )
            VALUES (?,?,?,?,?,?)';
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([$firstName, $lastName, $to, $username, password_hash($password, PASSWORD_DEFAULT), $token_hash]);

            $message = "Click to activate account\r\n" . APPLICATION_URL . "/activate.php?k=$encoded_token";
            $this->mailSubmissionAgent->send($to, 'Confirm Email', $message, ADMIN_EMAIL_FROM);

            header("Location: ./login.php?action=confirm");
            die;
        }
        catch (\PDOException $e)
        {
            if ($e->getCode() == '23000')
            {
                $error[] = 'Registration Failed<br>Invalid Username or Email';
                show_form_errors($error);
            }
            else
            {
                throw $e;
            }
        } // End Catch
    }
}
