<?php

namespace Unit\Http;

use PerfectApp\Session\Session;
use Codeception\Test\Unit;

class SessionTest extends Unit
{
    protected function _before()
    {
        session_start();
    }

    protected function _after()
    {
        session_destroy();
    }

    public function testGetAndSet()
    {
        $session = new Session();
        $session->set('foo', 'bar');

        $this->assertEquals('bar', $session->get('foo'));
    }

    public function testDelete()
    {
        $session = new Session();
        $session->set('foo', 'bar');

        $session->delete('foo');

        $this->assertNull($session->get('foo'));
    }
}
