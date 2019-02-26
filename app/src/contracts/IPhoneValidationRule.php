<?php
namespace App\Contracts;

interface IPhoneValidationRule
{
    public function validate(string $phone): bool;
    public function getCountryCode(): string;
}
