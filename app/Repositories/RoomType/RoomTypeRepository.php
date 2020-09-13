<?php
namespace App\Repositories\RoomType;
use App\Repositories\Crud\CrudRepository;
use App\Models\RoomType;
use App\Models\RoomTypeFeature;
class RoomTypeRepository extends CrudRepository implements RoomTypeInterface{
	public function __construct(RoomType $room_type,RoomTypeFeature $roomtype_feature){
		$this->model=$room_type;
		$this->roomtype_feature=$roomtype_feature;
	}
	public function create($data){
		$roomtype=$this->model->create($data);
		if($roomtype){
			return $roomtype;
		}
		return false;
	}
	public function update($data,$id){
		$this->model->find($id)->update($data);
	}
	public function saveData($data){
		$this->roomtype_feature->create($data);
	}
	public function deleteRoomTypefeature($id){
		$this->roomtype_feature->where('roomtype_id',$id)->delete();
	}
}