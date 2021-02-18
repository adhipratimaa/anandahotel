<?php
namespace App\Repositories\Gallery;
use App\Repositories\Crud\CrudInterface;
interface GalleryInterface extends CrudInterface{
	public function create($input);
	public function saveImage($input);
	public function deleteGalleryImages($id);
	public function updateImage($id,$input);
	public function update($input,$id);
}