<?php
namespace App\Repositories\RoomImage;
use App\Repositories\Crud\CrudInterface;
interface RoomImageInterface extends CrudInterface{
	public function create($data);
}