<?php

namespace app\Models;

use Illuminate\Database\Eloquent\Model;

class UserLog extends Model
{
	public $timestamps 		= false;
    protected $table 		= 'h_user_logs';
    protected $primaryKey 	= 'ul_id';
    protected $fillable 	= ['u_id', 'ul_logs', 'ul_login_time'];
}