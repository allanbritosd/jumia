<?php
namespace App\Business\PhoneValidations;

use App\Contracts\IPhoneValidationRule;

class CameroonPhoneValidationRule implements IPhoneValidationRule
{
    private $countryCode     = '237';
    private $regexValidation = '\(237\)\ ?[2368]\d{7,8}$';

    public function validate(string $phone): bool
    {
        return preg_match('/'.$this->regexValidation.'/', $phone);
    }

    public function getCountryCode(): string
    {
        return $this->countryCode;
    }
}
