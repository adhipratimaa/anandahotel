<?php
namespace App\Repositories\Service;
use App\Repositories\Crud\CrudRepository;
use App\Models\Service;
class ServiceRepository extends CrudRepository implements ServiceInterface{
	public function __construct(Service $service){
		$this->model=$service;
	}
	public function create($data){
		$this->model->create($data);
	}
	public function update($data,$id){
		$this->model->find($id)->update($data);
	}
}