<?php
namespace App\Repositories\Customer;
use App\Repositories\Crud\CrudRepository;
use App\Models\Customer;
class CustomerRepository extends CrudRepository implements CustomerInterface{
	public function __construct(Customer $customer){
		$this->model=$customer;
	}
	public function create($data){
		$result=$this->model->create($data);
		if($result){
			return $result;
		}
	}
}