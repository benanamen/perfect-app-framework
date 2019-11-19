<?php declare(strict_types=1);

namespace PerfectApp\Utilities;

/**
 * Class MessageHTML
 * @package PerfectApp\Utilities
 */
class MessageHTML implements MessageDisplay
{
    /**
     * @var ActionMessages
     */
    protected $allStatusMessages;

    /**
     * MessageHTML constructor.
     * @param ActionMessages $allStatusMessages Array of all status's & Messages
     */
    public function __construct(ActionMessages $allStatusMessages)
    {
        $this->allStatusMessages = $allStatusMessages;
    }

    /**
     * @param string $action various actions
     * @return string
     */
    final public function render(string $action): string
    {
        $statusMessage = $this->allStatusMessages->getStatus($action);

        return <<<HTML
            <div class="col-md-6 offset-md-3">
                    <div class="{$statusMessage['status']}">{$statusMessage['message']}</div>
            </div>
HTML;
    }
}
