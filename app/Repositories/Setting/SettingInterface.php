<?php
namespace App\Repositories\Setting;
use App\Repositories\Crud\CrudInterface;
interface SettingInterface extends CrudInterface{
	public function update($input,$id);
}