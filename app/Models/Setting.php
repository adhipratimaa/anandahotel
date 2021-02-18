<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $table='settings';
   	protected $fillable=['facebook','twitter','address','phone','email','youtube','about_us','map','about_us_description','image','instagram','video'];

   	public function youtubeVideo($url){
    	$url_string = parse_url($url, PHP_URL_QUERY);
  		parse_str($url_string, $args);
  		return isset($args['v']) ? $args['v'] : false;
    }
}
