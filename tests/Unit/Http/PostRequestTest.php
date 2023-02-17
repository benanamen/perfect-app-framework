<?php

namespace Unit\Http;

use Codeception\Test\Unit;
use PerfectApp\Http\PostRequest;

class PostRequestTest extends Unit
{
    public function testGet(): void
    {
        $_POST['foo'] = 'bar';

        $request = new PostRequest();

        $this->assertEquals('bar', $request->get('foo'));
        $this->assertNull($request->get('baz'));
    }

    public function testHas()
    {
        $_POST['foo'] = 'bar';

        $request = new PostRequest();

        $this->assertTrue($request->has('foo'));
        $this->assertFalse($request->has('baz'));
    }
}