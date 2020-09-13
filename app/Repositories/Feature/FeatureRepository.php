<?php
namespace App\Repositories\Feature;
use App\Models\Feature;
use App\Repositories\Crud\CrudRepository;
class FeatureRepository extends CrudRepository implements FeatureInterface{
	public function __construct(Feature $feature){
		$this->model=$feature;
	}
	public function create($data){
		$this->model->create($data);
	}
	public function update($data,$id){
		$this->model->find($id)->update($data);
	}
}
