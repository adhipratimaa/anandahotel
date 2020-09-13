<?php
namespace App\Repositories\RoomType;
use App\Repositories\Crud\CrudInterface;
interface RoomTypeInterface extends CrudInterface{
	public function create($data);
	public function update($data,$id);
	public function saveData($data);
	public function deleteRoomTypeFeature($id);
}