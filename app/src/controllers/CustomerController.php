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
        $length = $request['length'];
        $start  = $request['start'];
        if (isset($request['filters']['valid_numbers']) && !is_null($request['filters']['valid_numbers'])) {
        	$request['length'] = 0;
        	$request['start'] = 0;
        }
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

            if (isset($request['filters']['valid_numbers']) && !is_null($request['filters']['valid_numbers'])) {
            	if ($request['filters']['valid_numbers'] && !$validPhone) {
            		continue;
            	} else if (!$request['filters']['valid_numbers'] && $validPhone) {
            		continue;
            	}
            }

            $customerData[] = [
                $customerCountry,
                $validPhone ? 'OK' : 'NOK',
                $customerCountryCode,
                PhoneValidator::getPhone($customer->phone),
            ];
        }

        if (isset($request['filters']['valid_numbers']) && !is_null($request['filters']['valid_numbers'])) {
        	$customerCount = count($customerData);
        	$customerData = array_slice($customerData, $start, $length);
        }

        echo json_encode([
			'draw' => $request['draw'],
			'recordsTotal' => $customerCount,
			'recordsFiltered' => $customerCount,
            'data' => $customerData,
        ]);
    }
}
