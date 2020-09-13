<?php
namespace App\Repositories\Promo;
use App\Repositories\Crud\CrudInterface;
interface PromoInterface extends CrudInterface{
	public function create($data);
	public function update($data,$id);
}