<?php

namespace app\Models;

use Illuminate\Database\Eloquent\Model;

class Data extends Model
{
	public $timestamps 		= false;
    protected $table 		= 'h_data';
    protected $primaryKey 	= 'd_id';
    protected $dateTime 	= 'd_date_time_read';
	protected $fillable 	= ['ss_id', 'd_date_time_read', 'd_rain_value', 'd_rain_intensity', 'd_rain_duration', 'd_air_temperature', 'd_air_pressure', 'd_wind_speed', 'd_wind_direction', 'd_air_humidity', 'd_waterlevel'];
}