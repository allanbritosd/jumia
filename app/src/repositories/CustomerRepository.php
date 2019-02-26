<?php
namespace App\Repositories;

use App\Contracts\IModel;
use App\Lists\CustomerList;
use App\Models\Customer;

class CustomerRepository extends BaseRepository
{
    public function getTableName(): string
    {
        return 'customer';
    }

    public function createModel(): IModel
    {
        return new Customer;
    }

    public function createModelList(): \SplObjectStorage
    {
        return new CustomerList;
    }

    public function getWhereStatement(array $filters = []): string
    {
    	$where = '1=1';
    	if (!empty($filters['country']))
    	{
    		$where .= ' AND phone LIKE "('.$filters['country'].')%"';
    	}

    	return $where;
    }

}
