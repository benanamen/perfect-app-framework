<?php

namespace Unit\Http;

use Codeception\Test\Unit;
use PerfectApp\Http\PostRequest;

class PostRequestTest extends Unit
{
    public function testGet()
    {
        // Define test data for the POST request
        $postData = [
            'name' => 'John Doe',
            'email' => 'johndoe@example.com',
        ];

        // Instantiate the PostRequest class with the test data
        $postRequest = new PostRequest($postData);

        // Test that we can get the value of a POST parameter
        $this->assertEquals('John Doe', $postRequest->get('name'));
        $this->assertEquals('johndoe@example.com', $postRequest->get('email'));
        $this->assertNull($postRequest->get('invalid_key'));
    }

    public function testHas()
    {
        // Define test data for the POST request
        $postData = [
            'name' => 'John Doe',
            'email' => 'johndoe@example.com',
        ];

        // Instantiate the PostRequest class with the test data
        $postRequest = new PostRequest($postData);

        // Test that we can check if a POST parameter exists
        $this->assertTrue($postRequest->has('name'));
        $this->assertTrue($postRequest->has('email'));
        $this->assertFalse($postRequest->has('invalid_key'));
    }
}
