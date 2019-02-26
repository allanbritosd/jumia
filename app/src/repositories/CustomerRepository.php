<?php
namespace App\Repositories;

use App\Contracts\IModel;
use App\Models\Customer;
use App\Lists\CustomerList;

class CustomerRepository extends BaseRepository {
    public function getTableName(): string {
    	return 'customer';
    }

    public function createModel(): IModel {
    	return new Customer;
    }

    public function createModelList(): \SplObjectStorage {
    	return new CustomerList;
    }
}