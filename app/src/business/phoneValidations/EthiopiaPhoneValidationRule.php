<?php
namespace App\Business\PhoneValidations;

use App\Contracts\IPhoneValidationRule;

class EthiopiaPhoneValidationRule implements IPhoneValidationRule
{
    private $countryCode     = '251';
    private $regexValidation = '\(251\)\ ?[1-59]\d{8}$';

    public function validate(string $phone): bool
    {
        return preg_match('/'.$this->regexValidation.'/', $phone);
    }

    public function getCountryCode(): string
    {
        return $this->countryCode;
    }
}
