<?php declare(strict_types=1);

namespace Unit\Form;

use Codeception\Test\Unit;
use Exception;
use PerfectApp\Form\ValidateFormRequiredWhitelist;

class ValidateFormRequiredWhitelistTest extends Unit
{
    private array $whitelist = ['name', 'email', 'phone'];
    private array $requiredFields = ['name', 'email', 'phone'];

    /**
     * @throws Exception
     */
    public function testValidateWhiteList(): void
    {
        $validator = new ValidateFormRequiredWhitelist();
        $postData = ['name' => 'John', 'email' => 'john@example.com', 'phone' => '555-1234'];
        $validator->validateWhiteList($this->whitelist, $postData);
        $this->assertTrue(true); // No exception thrown, whitelist is valid
    }

    public function testValidateWhiteListInvalid(): void
    {
        $validator = new ValidateFormRequiredWhitelist();
        $postData = ['name' => 'John', 'email' => 'john@example.com', 'invalidField' => 'HackData'];
        $this->expectException(Exception::class);
        $validator->validateWhiteList(['name', 'email', 'phone', 'password'], $postData);
    }

    public function testRequiredFieldCheck(): void
    {
        $validator = new ValidateFormRequiredWhitelist();
        $postData = ['name' => 'John', 'email' => 'john@example.com', 'phone' => '555-1234'];
        $errors = $validator->requiredFieldCheck($this->requiredFields, $postData);
        $this->assertEmpty($errors); // No errors, required fields are present
    }

    public function testRequiredFieldCheckMissingField(): void
    {
        $validator = new ValidateFormRequiredWhitelist();
        $postData = ['name' => 'John', 'phone' => '555-1234'];
        $errors = $validator->requiredFieldCheck($this->requiredFields, $postData);
        $this->assertCount(1, $errors); // One error, one required field is missing
        $this->assertArrayHasKey('email', $errors); // Error is for missing email field
        $this->assertEquals('Email Required', $errors['email']); // Error message is correct
    }
}
