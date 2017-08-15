<?php

namespace app\Models;

use Illuminate\Database\Eloquent\Model;

class SmsTimestamp extends Model
{
    protected $table 		= 'h_sms_timestamp';
    protected $primaryKey 	= 'id';
	protected $fillable 	= ['last_msg'];
}