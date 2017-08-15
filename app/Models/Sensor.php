<?php

namespace app\Models;

use Illuminate\Database\Eloquent\Model;

class Sensor extends Model
{
    protected $table 		= 'h_sensors';
    protected $primaryKey 	= 'ss_id';
    protected $fillable 	= ['ss_address', 'ss_latitude', 'ss_longitude', 'ss_elevation', 'ss_type', 'dev_id', 'is_active'];
}