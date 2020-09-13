<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $fillable=['name','roomtype_id','image','description','publish','price','short_description'];

    public function roomImages(){
    	return $this->hasMany('App\Models\RoomImage');
    }
    public function features(){
    	return $this->belongsToMany('App\Models\Feature','room_features','room_id','feature_id');
   }
   public function roomType(){
   		return $this->belongsTo('App\Models\RoomType','roomtype_id');
   }
}
