<?php

namespace Unit\Http;

use Codeception\Test\Unit;
use DateTime;
use PerfectApp\Http\Cookie;

class CookieTest extends Unit
{
    protected $tester;

    /**
     * Test setting and getting a cookie
     */
    public function testSetAndGet()
    {
        // Arrange
        $cookie = new Cookie([]);
        $key = 'test_key';
        $value = 'test_value';

        // Act
        $cookie->set($key, $value);
        $result = $cookie->get($key);

        // Assert
        $this->assertEquals($value, $result);
    }

    /**
     * Test deleting a cookie
     */
    public function testDelete()
    {
        // Arrange
        $cookie = new Cookie([]);
        $key = 'test_key';
        $value = 'test_value';

        // Act
        $cookie->set($key, $value);
        $cookie->delete($key);
        $result = $cookie->get($key);

        // Assert
        $this->assertNull($result);
    }
}
