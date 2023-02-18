<?php

namespace Unit\Http;

use Codeception\Test\Unit;
use PerfectApp\Http\GetRequest;

class GetRequestTest extends Unit
{
    private $getRequest;

    protected function _before()
    {
        $this->getRequest = new GetRequest([
            'param1' => 'value1',
            'param2' => 'value2',
        ]);
    }

    public function testGetExistingParam()
    {
        $this->assertEquals('value1', $this->getRequest->get('param1'));
    }

    public function testGetNonexistentParam()
    {
        $this->assertNull($this->getRequest->get('nonexistent'));
    }

    public function testHasExistingParam()
    {
        $this->assertTrue($this->getRequest->has('param2'));
    }

    public function testHasNonexistentParam()
    {
        $this->assertFalse($this->getRequest->has('nonexistent'));
    }
}
