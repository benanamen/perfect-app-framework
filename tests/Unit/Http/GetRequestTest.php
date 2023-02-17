<?php

namespace Unit\Http;

use Codeception\Test\Unit;
use PerfectApp\Http\GetRequest;

class GetRequestTest extends Unit
{
    public function testGet()
    {
        $_GET = [
            'foo' => 'bar',
            'baz' => 'qux',
        ];

        $getRequest = new GetRequest();

        $this->assertEquals('bar', $getRequest->get('foo'));
        $this->assertEquals('qux', $getRequest->get('baz'));
        $this->assertNull($getRequest->get('non-existent-key'));
    }

    public function testHas()
    {
        $_GET = [
            'foo' => 'bar',
            'baz' => 'qux',
        ];

        $getRequest = new GetRequest();

        $this->assertTrue($getRequest->has('foo'));
        $this->assertTrue($getRequest->has('baz'));
        $this->assertFalse($getRequest->has('non-existent-key'));
    }
}