<?php
namespace App\Repositories\Room;
use App\Repositories\Crud\CrudRepository;
use App\Models\Room;
use App\Models\RoomFeature;
class RoomRepository extends CrudRepository implements RoomInterface{
	public function __construct(Room $room,RoomFeature $roomfeature){
		$this->model=$room;
		$this->roomfeature=$roomfeature;
	}
	public function create($data){
		$room=$this->model->create($data);
		if($room){
			return $room;
		}

	}
	public function update($data,$id){
		$this->model->find($id)->update($data);
	}
	public function saveData($data){
		$this->roomfeature->create($data);
	}
	public function deleteRoomfeature($id){
		$this->roomfeature->where('room_id',$id)->delete();
	}
}
