<?php
namespace App\Repositories\Setting;
use App\Models\Setting;
use App\Repositories\Crud\CrudRepository;
class SettingRepository extends CrudRepository implements SettingInterface{
	public function __construct(Setting $setting){
		$this->model=$setting;
	}
	public function update($input,$id){
		$this->model->find($id)->update($input);
	}
}