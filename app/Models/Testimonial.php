<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    protected $fillable=['name','position','description','image','facebook','instagram','twitter','publish','type'];
}
