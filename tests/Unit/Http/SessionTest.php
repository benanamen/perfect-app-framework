<?php

namespace Unit\Http;

use PerfectApp\Session\Session;
use Codeception\Test\Unit;

class SessionTest extends Unit
{
    protected function _before()
    {
        // Start code coverage
        xdebug_start_code_coverage();

        // Start a new session for each test
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        // Clear the session data before each test
        $_SESSION = [];
    }

    public function testConstructorStartsSession()
    {
        $this->assertNotEmpty(session_id());
    }

    public function testSetAndGet()
    {
        $session = new Session();
        $session->set('name', 'John');
        $this->assertEquals('John', $session->get('name'));
    }

    public function testDelete()
    {
        $session = new Session();
        $session->set('name', 'John');
        $session->delete('name');
        $this->assertNull($session->get('name'));
    }

    public function testConstructorWithSessionData()
    {
        $_SESSION['name'] = 'John';
        $session = new Session();
        $this->assertEquals('John', $session->get('name'));
    }

    public function testConstructorWithoutSessionData()
    {
        $session = new Session();
        $this->assertEmpty($session->get('name'));
    }
}
