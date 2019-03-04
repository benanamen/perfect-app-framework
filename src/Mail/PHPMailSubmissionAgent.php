<?php declare(strict_types=1);

namespace PerfectApp\Mail;

/**
 * Class PHPMailSubmissionAgent
 * @package krubio\Mail
 */
class PHPMailSubmissionAgent implements MailSubmissionAgent
{
    /**
     * @param string $to
     * @param string $subject
     * @param string $message
     * @param string $from
     */
    public function send($to, $subject, $message, $from)
    {
        mail($to, $subject, $message, "From: $from");
    }
}
