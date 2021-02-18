<?php
namespace App\Repositories\Gallery;
use App\Models\Gallery;
use App\Models\GalleryImage;
use Illuminate\Support\Str;
use App\Repositories\Crud\CrudRepository;
class GalleryRepository extends CrudRepository implements GalleryInterface{
	private $galleryImage;
	public function __construct(Gallery $gallery,GalleryImage $galleryImage){
		$this->model=$gallery;
		$this->galleryImage=$galleryImage;
	}
	public function create($input){
		$value=$input;
		$value['slug']=!empty($input['slug']) ? \Str::slug($input['slug']) : str::slug($input['title']);
		$result=$this->model->create($value);
		if($result){
			return $result->id;
		}
		return false;
	}
	public function saveImage($input){
		$this->galleryImage->create($input);
	}
	public function update($input,$id){
		$gallery=$this->model->find($id);
		$value=$input;
		if($value['slug']!==$input['slug']){
			$value['slug']==\Str::slug($input['slug']);
		}
		$this->model->find($id)->update($value);
	}

	public function deleteGalleryImages($id){
		$this->galleryImage->where('gallery_id',$id)->delete();
	}
	public function updateImage($id,$input){
		$this->galleryImage->create($input);
	}
}