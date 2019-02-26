<?php
namespace App\Business\PhoneValidations;

use App\Contracts\IPhoneValidationRule;

class MozambiquePhoneValidationRule implements IPhoneValidationRule
{
    private $countryCode     = '258';
    private $regexValidation = '\(258\)\ ?[28]\d{7,8}$';

    public function validate(string $phone): bool
    {
        return preg_match('/'.$this->regexValidation.'/', $phone);
    }

    public function getCountryCode(): string
    {
        return $this->countryCode;
    }
}
