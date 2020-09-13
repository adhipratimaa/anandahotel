<?php
namespace App\Repositories\RoomTypeImage;
use App\Repositories\Crud\CrudInterface;
interface RoomTypeImageInterface extends CrudInterface{
	public function create($data);
}