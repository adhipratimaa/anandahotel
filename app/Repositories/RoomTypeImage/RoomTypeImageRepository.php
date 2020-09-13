<?php
namespace App\Repositories\RoomTypeImage;
use App\Models\RoomTypeImage;
use App\Repositories\Crud\CrudRepository;
class RoomTypeImageRepository extends CrudRepository implements RoomTypeImageInterface{
	public function __construct(RoomTypeImage $roomTypeImage){
		$this->model=$roomTypeImage;
	}
	public function create($data){
		$this->model->create($data);
	}
}