<?php
namespace App\Models;

use App\Contracts\IModel;

class Customer implements IModel {
    public $id;
    public $name;
    public $phone;

    public function fill(array $data) {
    	$this->id = $data['id'] ?? null;
	    $this->name = $data['name'] ?? null;
	    $this->phone = $data['phone'] ?? null;
    }
}