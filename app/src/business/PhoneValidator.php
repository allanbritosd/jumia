<?php
namespace App\Business;

use App\Contracts\IPhoneValidationRule;
use App\Exceptions\PhoneValidation\CountryNotFoundException;

class PhoneValidator
{
    private static $validations = [];

    public static function registerRule(IPhoneValidationRule $rule)
    {
        self::$validations[$rule->getCountryCode()] = $rule;
    }

    public static function validate(string $phone): bool
    {
        $countryCode = self::getCountryCode($phone);
        if (empty(self::$validations[$countryCode])) {
            throw new CountryNotFoundException("Country code not found");
        }

        return self::$validations[$countryCode]->validate($phone);
    }

    public static function getCountryCode(string $phone): string
    {
        return preg_replace('/^\((\d+)\).+/', '$1', $phone);
    }

    public static function getPhone(string $phone): string
    {
        return preg_replace('/^\(\d+\) ?(.+)/', '$1', $phone);
    }

    public static function getCountries(): array
    {
        $countries = [];

        foreach(self::$validations as $validation) {
            $countries[$validation->getCountryCode()] = (object) [
                'code' => $validation->getCountryCode(),
                'name' => $validation->getCountryName(),
            ];
        }

        return $countries;
    }
}
