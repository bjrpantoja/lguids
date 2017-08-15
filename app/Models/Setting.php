<?php

namespace app\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $table 		= 'h_settings';
    protected $primaryKey 	= 'st_id';	
    protected $fillable 	= ['st_name', 'st_alias', 'st_footer', 'st_about', 'st_globe', 'st_smart', 'st_facebook', 'st_twitter', 'st_google', 'st_address', 'st_extra', 'st_earthquake', 'st_weather', 'st_volcano', 'st_cyclone'];
}