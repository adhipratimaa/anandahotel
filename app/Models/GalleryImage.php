<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GalleryImage extends Model
{
    protected $table='gallery_images';
    protected $fillable=['gallery_id','filename','caption'];

    public function gallery(){
		return $this->belongsTo('App\Models\Gallery');
	}
}
