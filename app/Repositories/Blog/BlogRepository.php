<?php
namespace App\Repositories\Blog;
use App\Models\Blog;
use App\Repositories\Crud\CrudRepository;
class BlogRepository extends CrudRepository implements BlogInterface{
	public function __construct(Blog $blog){
		$this->model=$blog;
	}
	public function create($input){
		$value=$input;
		$value['slug']=!empty($input['slug'])? str_slug($input['slug']) : str_slug($input['title']);
		$this->model->create($value);
	}
	public function update($input,$id){
		$blog=$this->model->find($id);
		$value=$input;
		if($value['slug']!==$blog['slug']){
			$value['slug']=str_slug($input['slug']);
		}
		$this->model->find($id)->update($value);
	}
}