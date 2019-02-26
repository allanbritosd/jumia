<?php
namespace App\Controllers;

use App\Business\PhoneValidator;
use App\Exceptions\PhoneValidation\CountryNotFoundException;
use App\Repositories\CustomerRepository;

class CustomerController
{
    public function getAll($request)
    {
        $customerRepository = new CustomerRepository();
        $customerList       = $customerRepository->findAll($request['filters'] ?? [], $request['length'], $request['start']);
        $customerCount      = $customerRepository->count($request['filters'] ?? []);
        $customerData       = [];

        $countries = PhoneValidator::getCountries();

        foreach ($customerList as $customer) 
        {
            try
            {
                $validPhone = PhoneValidator::validate($customer->phone);
            } catch (CountryNotFoundException $e)
            {
                $validPhone = false;
            }

            $customerCountry     = 'Not Identified';
            $customerCountryCode = '-';
            foreach ($countries as $code => $country)
            {
                if ($code == PhoneValidator::getCountryCode($customer->phone))
                {
                    $customerCountry     = $country->name;
                    $customerCountryCode = "+" . $country->code;
                    break;
                }
            }

            $customerData[] = [
                $customerCountry,
                $validPhone ? 'OK' : 'NOK',
                $customerCountryCode,
                PhoneValidator::getPhone($customer->phone),
            ];
        }

        echo json_encode([
			'draw' => $request['draw'],
			'recordsTotal' => $customerCount,
			'recordsFiltered' => $customerCount,
            'data' => $customerData,
        ]);
    }
}
