<?php

namespace Unit\Http;

use Codeception\Test\Unit;
use PerfectApp\Http\Request;

class RequestTest extends Unit
{
    protected function _before()
    {
        $_REQUEST = [];
    }

    public function testGet()
    {
        $_REQUEST['foo'] = 'bar';

        $request = new Request();

        $this->assertEquals('bar', $request->get('foo'));
        $this->assertNull($request->get('baz'));
    }

    public function testHas()
    {
        $_REQUEST['foo'] = 'bar';

        $request = new Request();

        $this->assertTrue($request->has('foo'));
        $this->assertFalse($request->has('baz'));
    }
}
