<?php
namespace App\Repositories\ServiceImage;
use App\Repositories\Crud\CrudInterface;
interface ServiceImageInterface extends CrudInterface{
	public function create($data);
}