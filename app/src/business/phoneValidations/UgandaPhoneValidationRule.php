<?php
namespace App\Business\PhoneValidations;

use App\Contracts\IPhoneValidationRule;

class UgandaPhoneValidationRule implements IPhoneValidationRule
{
    private $countryCode     = '256';
    private $countryName     = 'Uganda';
    private $regexValidation = '\(256\)\ ?\d{9}$';

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
