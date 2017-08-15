<?php

namespace app\Models;

use Illuminate\Database\Eloquent\Model;

class Bulletin extends Model
{
    protected $table 		= 'h_bulletins';
    protected $primaryKey 	= 'bl_id';
    protected $fillable 	= ['bl_message', 'bt_id', 'bl_type'];

    public function bulletin_type()
    {
    	return $this->hasOne('app\Models\BulletinType', 'bt_id', 'bt_id');
    }

    public function bulletin_recipients()
    {
    	return $this->belongsToMany('app\Models\Contact', 'h_bulletin_recipients', 'bl_id', 'c_id')->withTimestamps();
    }

    public function bulletin_sent()
    {
		return $this->belongsToMany('app\Models\Contact', 'h_bulletin_recipients', 'bl_id', 'c_id')->where('blr_status', '=', 'SENT')->withTimestamps();
    }

    public function bulletin_failed()
    {
		return $this->belongsToMany('app\Models\Contact', 'h_bulletin_recipients', 'bl_id', 'c_id')->where('blr_status', '=', 'FAILED')->withTimestamps();
    }
}