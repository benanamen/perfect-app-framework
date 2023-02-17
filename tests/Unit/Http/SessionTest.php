<?php

namespace Unit\Http;

use PerfectApp\Session\Session;
use PHPUnit\Framework\TestCase;

class SessionTest extends TestCase
{
    protected function setUp(): void
    {
        session_start();
    }

    protected function tearDown(): void
    {
        session_destroy();
    }

    public function testSetAndGet()
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

    public function testStart()
    {
        $session = new Session();

        $session->start();

        $this->assertSame(PHP_SESSION_ACTIVE, session_status());
    }
}
