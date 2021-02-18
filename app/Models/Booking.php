<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'room_id', 
        'roomtype_id',
        'checkIn_date', 
        'checkIn_time', 
        'checkOut_date', 
        'checkOut_time', 
        'person', 'child', 
        'senior_citizen', 
        'vegeterian', 
        'group_id', 
        'customer_id', 
        'added_by', 
        'advance', 
        'price', 
        'status', 
        'discount_id', 
        'discount_title', 
        'discount',
        // 'resto_order',
        // 'restro_order_color',
        'payment_method',
        'join',
        'customer_id',
        'number_of_rooms',
    ];

    public function room(){
        return $this->belongsTo('App\Models\Room','room_id');
    }
    public function roomType(){
        return $this->belongsTo('App\Models\RoomType','roomtype_id');
    }
}
