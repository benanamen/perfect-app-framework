<?php declare(strict_types=1);

namespace PerfectApp\Utilities;

/**
 * Flash notification messages: messages for one-time display using the session
 * for storage between requests.
 *
 * PHP version 7.0
 */
class Flash
{

    /**
     * Add a message
     *
     * @param string $message The message content
     * @param string $type The optional message type, defaults to SUCCESS
     *
     * @return void
     */

    public static function addMessage(string $message, string $type = 'success'): void
    {
        // Create array in the session if it doesn't already exist
        if (!isset($_SESSION['flash_notifications']))
        {
            $_SESSION['flash_notifications'] = [];
        }

        // Append the message to the array
        $_SESSION['flash_notifications'][] = [
            'body' => $message,
            'type' => $type
        ];
    }

    /**
     *
     */
    public static function displayMessages(): void
    {
        $flash = (new self)->getMessages();

        if ($flash)
        {
            foreach ($flash as $message)
            {
                //TODO: Original format echo "<div class='col-md-6 offset-md-3'><div class='{$message['type']}'>{$message['body']}</div></div>";
                echo "<div class='col-md-6 offset-md-3'><div class='alert alert-{$message['type']}'>{$message['body']}</div></div>";
            }
        }
    }

    /**
     *  Get all the messages
     *
     * @return array An array with all the messages or null if none set
     */

    private function getMessages(): array
    {
        $messages = [];

        if (isset($_SESSION['flash_notifications']))
        {
            $messages = $_SESSION['flash_notifications'];
            unset($_SESSION['flash_notifications']);
        }
        return $messages;
    }
}
