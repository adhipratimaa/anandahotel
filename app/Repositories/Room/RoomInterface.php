<?php
namespace App\Repositories\Room;
use App\Repositories\Crud\CrudInterface;
interface RoomInterface extends CrudInterface{
	public function create($data);
	public function update($data,$id);
	public function saveData($data);
	public function deleteRoomfeature($id);
}