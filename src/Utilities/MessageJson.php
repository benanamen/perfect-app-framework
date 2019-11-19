<?php declare(strict_types=1);

namespace PerfectApp\Utilities;

/**
 * Class MessageJson
 * @package PerfectApp\Utilities
 */
class MessageJson implements MessageDisplay
{
    /**
     * @var ActionMessages
     */
    protected $allStatusMessages;

    /**
     * MessageJson constructor.
     * @param ActionMessages $allStatusMessages Array of all status's & Messages
     */
    public function __construct(ActionMessages $allStatusMessages)
    {
        $this->allStatusMessages = $allStatusMessages;
    }

    /**
     * @param string $action
     * @return string
     */
    final public function render(string $action): string
    {
        $statusMessage = $this->allStatusMessages->getStatus($action);

        return <<<JSON
            {
                "message": {$statusMessage['message']},
                "status": {$statusMessage['status']}
            }
JSON;
    }
}
