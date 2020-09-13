<?php
namespace App\Repositories\Feature;
use App\Repositories\Crud\CrudInterface;
interface FeatureInterface extends CrudInterface{
	public function create($data);
	public function update($data,$id);
}