<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable=['first_name','last_name','email','phone_number','promo_id', 'special_request'];

    public function bookings(){
    	return $this->hasMany('App\Models\Booking','customer_id');
    }
    public function promo(){
    	return $this->belongsTo('App\Models\Promo','promo_id');
    }
}
