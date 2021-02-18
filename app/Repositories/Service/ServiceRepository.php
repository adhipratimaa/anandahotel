<?php
namespace App\Repositories\Service;
use App\Repositories\Crud\CrudRepository;
use App\Models\Service;
class ServiceRepository extends CrudRepository implements ServiceInterface{
	public function __construct(Service $service){
		$this->model=$service;
	}
	public function create($input){
		$data=$input;
		$data['slug']=!empty($input['slug'])? str_slug($input['slug']) : str_slug($input['title']);
		$this->model->create($data);
	}
	public function update($input,$id){
		$service=$this->model->find($id);

		$data=$input;
		if($data['slug']!==$service['slug']){
			$data['slug']=str_slug($input['slug']);
		}
		$this->model->find($id)->update($data);
		
	}
}