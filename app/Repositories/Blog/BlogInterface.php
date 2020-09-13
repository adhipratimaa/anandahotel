<?php
namespace App\Repositories\Blog;
use App\Repositories\Crud\CrudInterface;
interface BlogInterface extends CrudInterface{
	public function create($input);
	public function update($input,$id);
}