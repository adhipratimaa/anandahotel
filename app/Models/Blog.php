<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $table='blogs';
    protected $fillable=['title','description','image','publish','slug','meta_title','meta_description','writer','keyword','short_description','author'];
}
