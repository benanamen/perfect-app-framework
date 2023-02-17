<?php

namespace Unit\Http;

use Codeception\Test\Unit;
use PerfectApp\Http\Cookie;

class CookieTest extends Unit
{
    protected function _before()
    {
        $_COOKIE = [];
    }

    public function testGet()
    {
        $_COOKIE['foo'] = 'bar';

        $cookie = new Cookie();

        $this->assertEquals('bar', $cookie->get('foo'));
        $this->assertNull($cookie->get('baz'));
    }

    public function testSet()
    {
        $cookie = new Cookie();

        $cookie->set('foo', 'bar', time() + 3600, '/', '', true, true);

        $this->assertEquals('bar', $_COOKIE['foo']);
    }

    public function testDelete()
    {
        $cookie = new Cookie();
        $cookie->set('foo', 'bar');

        $cookie->delete('foo');

        $this->assertNull($cookie->get('foo'));
    }
}
