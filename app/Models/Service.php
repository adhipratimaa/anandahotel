<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable=['title','description','image','publish','logo'];

    public function serviceImages(){
    	return $this->hasMany('App\Models\ServiceImage');
    }
}
