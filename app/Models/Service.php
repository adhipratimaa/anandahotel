<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable=['title','description','image','publish','logo', 'show_in_menu', 'slug', 'category'];

    public function serviceImages(){
    	return $this->hasMany('App\Models\ServiceImage');
    }
}
