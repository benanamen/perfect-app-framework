<?php declare(strict_types=1);

namespace PerfectApp\Mail;

/**
 * Class PHPMailSubmissionAgent
 * @package PerfectApp\Mail
 */
class PHPMailSubmissionAgent implements MailSubmissionAgent
{
    /**
     * @param string $to
     * @param string $subject
     * @param string $message
     * @param string $from
     * @return bool
     */
    final public function send(string $to, string $subject, string $message, string $from): bool
    {
        return mail($to, $subject, $message, "From: $from");
    }
}
