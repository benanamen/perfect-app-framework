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
     * @param array $headers
     * @return bool
     */
    final public function send(string $to, string $subject, string $message, array $headers): bool
    {
        return mail($to, $subject, $message, implode("\r\n", $headers));
    }
}
