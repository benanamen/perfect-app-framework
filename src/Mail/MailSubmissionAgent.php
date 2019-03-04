<?php declare(strict_types=1);

namespace PerfectApp\Mail;


interface MailSubmissionAgent
{
    /**
     * Sends an e-mail to a single address
     *
     * @param $to      string the receiver address
     * @param $subject string the mail subject
     * @param $message    string the mail body
     * @param $from    string the sender address
     */
    public function send($to, $subject, $message, $from);
}
