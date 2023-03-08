<?php

namespace Unit\Http;

use Codeception\Test\Unit;
use PerfectApp\Http\PostRequest;

class PostRequestTest extends Unit
{
    const JOHN_DOE = 'John Doe';
    const JOHNDOE_EXAMPLE_COM = 'johndoe@example.com';

    public function testGet()
    {
        // Define test data for the POST request
        $postData = [
            'name' => self::JOHN_DOE,
            'email' => self::JOHNDOE_EXAMPLE_COM,
        ];

        // Instantiate the PostRequest class with the test data
        $postRequest = new PostRequest($postData);

        // Test that we can get the value of a POST parameter
        $this->assertEquals(self::JOHN_DOE, $postRequest->get('name'));
        $this->assertEquals(self::JOHNDOE_EXAMPLE_COM, $postRequest->get('email'));
        $this->assertNull($postRequest->get('invalid_key'));
    }

    public function testHas()
    {
        // Define test data for the POST request
        $postData = [
            'name' => self::JOHN_DOE,
            'email' => self::JOHNDOE_EXAMPLE_COM,
        ];

        // Instantiate the PostRequest class with the test data
        $postRequest = new PostRequest($postData);

        // Test that we can check if a POST parameter exists
        $this->assertTrue($postRequest->has('name'));
        $this->assertTrue($postRequest->has('email'));
        $this->assertFalse($postRequest->has('invalid_key'));
    }
}
