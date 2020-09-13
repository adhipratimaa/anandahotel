<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Promo extends Model
{
    protected $fillable =['title','promo_code','type','discount','promo_service','publish'];
}
