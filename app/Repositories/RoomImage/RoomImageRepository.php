<?php
namespace App\Repositories\RoomImage;
use App\Models\RoomImage;
use App\Repositories\Crud\CrudRepository;
class RoomImageRepository extends CrudRepository implements RoomImageInterface{
	public function __construct(RoomImage $roomImage){
		$this->model=$roomImage;
	}
	public function create($data){
		$this->model->create($data);
	}
}