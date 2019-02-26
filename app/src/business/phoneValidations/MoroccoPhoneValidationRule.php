<?php
namespace App\Business\PhoneValidations;

use App\Contracts\IPhoneValidationRule;

class MoroccoPhoneValidationRule implements IPhoneValidationRule
{
    private $countryCode     = '212';
    private $countryName     = 'Morocco';
    private $regexValidation = '\(212\)\ ?[5-9]\d{8}$';

    public function validate(string $phone): bool
    {
        return preg_match('/'.$this->regexValidation.'/', $phone);
    }

    public function getCountryCode(): string
    {
        return $this->countryCode;
    }

    public function getCountryName(): string
    {
        return $this->countryName;
    }
}
