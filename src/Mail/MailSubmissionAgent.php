<?php declare(strict_types=1);

namespace PerfectApp\Mail;


/**
 * Interface MailSubmissionAgent
 * @package PerfectApp\Mail
 */
interface MailSubmissionAgent
{

    /**
     * Sends an e-mail to a single address
     *
     * @param string $to the receiver address
     * @param string $subject the mail subject
     * @param string $message the mail body
     * @param string $from the sender address
     * @return bool
     */
    public function send(string $to, string $subject, string $message, string $from): bool;
}
