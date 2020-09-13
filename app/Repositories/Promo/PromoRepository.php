<?php
namespace App\Repositories\Promo;
use App\Models\Promo;
use App\Repositories\Crud\CrudRepository;
class PromoRepository extends CrudRepository implements PromoInterface{
	public function __construct(Promo $promo){
		$this->model=$promo;
	}
	public function create($data){
		$this->model->create($data);
	}
	public function update($data,$id){
		$this->model->find($id)->update($data);
	}
}