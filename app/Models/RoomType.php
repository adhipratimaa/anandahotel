<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RoomType extends Model
{
    protected $fillable=['name','publish','room_capacity','short_description','price','image','slug', 'description'];


    public function features(){
    	return $this->belongsToMany('App\Models\Feature','room_type_features','roomtype_id','feature_id');
    }
    public function rooms(){
    	return $this->hasMany('App\Models\Room','roomtype_id');
    }
    public function images(){
    	return $this->hasMany('App\Models\RoomTypeImage','roomtype_id');
    }
}
