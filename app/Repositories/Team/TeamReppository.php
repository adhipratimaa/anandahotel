<?php
namespace App\Repositories\Team;
use App\Models\Team;
use App\Repositories\Crud\CrudRepository;
class TeamRepository extends CrudRepository implements TeamInterface{
	public function __construct(Team $team){
		$this->model=$team;
	}
	public function create($data){
		$this->model->create($data);
	}
	public function update($data,$id){
		$this->model->find($id)->update($data);
	}
}