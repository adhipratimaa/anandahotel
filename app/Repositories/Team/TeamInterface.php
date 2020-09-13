<?php
namespace App\Repositories\Team;
use App\Repositories\Crud\CrudInterface;
interface TeamInterface extends CrudInterface{
	public function create($data);
	public function update($data,$id);
}