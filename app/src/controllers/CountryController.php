<?php
namespace App\Controllers;

use App\Business\PhoneValidator;

class CountryController
{
    public function getAll() {
    	echo json_encode(PhoneValidator::getCountries());
    }
}
