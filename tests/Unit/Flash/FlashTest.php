<?php

namespace Unit\Flash;

use Codeception\Test\Unit;
use PerfectApp\Utilities\Flash;

class FlashTest extends Unit
{
    protected function _before()
    {
        // start session for testing
        session_start();
    }

    protected function _after()
    {
        // clear session after testing
        session_unset();
        session_destroy();
    }

    public function testAddMessage()
    {
        // add a message and check session variable
        Flash::addMessage('Test message');
        $this->assertEquals([['body' => 'Test message', 'type' => 'success']], $_SESSION['flash_notifications']);
    }

    public function testAddMessageWithType()
    {
        // add a message with type and check session variable
        Flash::addMessage('Test message', 'warning');
        $this->assertEquals([['body' => 'Test message', 'type' => 'warning']], $_SESSION['flash_notifications']);
    }

    public function testGetMessages()
    {
        // set session variable and check returned value
        $_SESSION['flash_notifications'] = [['body' => 'Test message', 'type' => 'info']];
        $messages = (new Flash())->getMessages();
        $this->assertEquals([['body' => 'Test message', 'type' => 'info']], $messages);
    }

    public function testGetMessagesEmpty()
    {
        // check returned value when session variable is not set
        $messages = (new Flash())->getMessages();
        $this->assertEmpty($messages);
    }

    public function testDisplayMessages()
    {
        // set session variable and check HTML output
        $_SESSION['flash_notifications'] = [['body' => 'Test message', 'type' => 'success']];
        ob_start();
        Flash::displayMessages();
        $output = ob_get_clean();
        $expected = "<div class='col-md-6 offset-md-3'><div class='alert alert-success'>Test message</div></div>";
        $this->assertStringContainsString($expected, $output);
    }

    public function testDisplayMessagesEmpty()
    {
        // check HTML output when session variable is not set
        ob_start();
        Flash::displayMessages();
        $output = ob_get_clean();
        $this->assertEmpty($output);
    }
}
