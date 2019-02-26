<?php
namespace App\Controllers;

use App\Repositories\CustomerRepository;

class CustomerController
{
    public function getAll() {
    	$customerRepository = new CustomerRepository();
    	echo json_encode($customerRepository->findAll());
    }
}
