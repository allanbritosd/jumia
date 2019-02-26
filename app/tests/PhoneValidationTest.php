<?php
use App\Business\PhoneValidator;
use PHPUnit\Framework\TestCase;

class PhoneValidationTest extends TestCase
{
    public function testValidCameroonNumber()
    {
        $this->assertTrue(PhoneValidator::validate('(237) 697151134'));
    }

    public function testInvalidCameroonNumber()
    {
        $this->assertFalse(PhoneValidator::validate('(237) 197151134'));
    }

    public function testValidEthiopiaNumber()
    {
        $this->assertTrue(PhoneValidator::validate('(251) 594701245'));
    }

    public function testInvalidEthiopiaNumber()
    {
        $this->assertFalse(PhoneValidator::validate('(251) 814701245'));
    }

    public function testValidMoroccoNumber()
    {
        $this->assertTrue(PhoneValidator::validate('(212) 691931233'));
    }

    public function testInvalidMoroccoNumber()
    {
        $this->assertFalse(PhoneValidator::validate('(212) 191931233'));
    }

    public function testValidMozambiqueNumber()
    {
        $this->assertTrue(PhoneValidator::validate('(258) 823712345'));
    }

    public function testInvalidMozambiqueNumber()
    {
        $this->assertFalse(PhoneValidator::validate('(258) 123712345'));
    }

    public function testValidUgandaNumber()
    {
        $this->assertTrue(PhoneValidator::validate('(256) 714661233'));
    }

    public function testInvalidUgandaNumber()
    {
        $this->assertFalse(PhoneValidator::validate('(256) 14661233'));
    }
}
