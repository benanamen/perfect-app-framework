<?php

namespace Unit\Http;

use Codeception\Test\Unit;
use PerfectApp\Http\Request;

class RequestTest extends Unit
{
/*    protected function _before()
    {
        $_REQUEST = [];
    }*/

    public function testGet()
    {
        $requestData = ['foo' => 'bar', 'baz' => 'qux'];
        $request = new Request($requestData);

        $this->assertEquals('bar', $request->get('foo'));
        $this->assertEquals('qux', $request->get('baz'));
        $this->assertNull($request->get('not_set'));
    }

    public function testHas()
    {
        $requestData = ['foo' => 'bar', 'baz' => 'qux'];
        $request = new Request($requestData);

        $this->assertTrue($request->has('foo'));
        $this->assertTrue($request->has('baz'));
        $this->assertFalse($request->has('not_set'));
    }
}
