<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    protected $table='galleries';
    protected $fillable=['title','slug','description','list_image','is_active'];

    public function images(){
		return $this->hasMany('App\Models\GalleryImage');
	}
}
