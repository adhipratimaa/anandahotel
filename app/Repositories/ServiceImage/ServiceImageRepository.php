<?php
namespace App\Repositories\ServiceImage;
use App\Models\ServiceImage;
use App\Repositories\Crud\CrudRepository;
class ServiceImageRepository extends CrudRepository implements ServiceImageInterface{
	public function __construct(ServiceImage $service_image){
		$this->model=$service_image;
	}
	public function create($data){
		$this->model->create($data);
	}
}