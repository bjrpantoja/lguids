<?php

namespace app\Models;

use Illuminate\Database\Eloquent\Model;

class Map extends Model
{
    protected $table 		= 'h_maps';
    protected $primaryKey 	= 'm_id';
	protected $fillable 	= ['m_name', 'm_type', 'm_path', 'is_active'];
}