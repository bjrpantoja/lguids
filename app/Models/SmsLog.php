<?php

namespace app\Models;

use Illuminate\Database\Eloquent\Model;

class SmsLog extends Model
{
    protected $table 		= 'h_sms_logs';
    protected $primaryKey 	= 'sl_id';
	protected $fillable 	= ['sl_number', 'sl_message', 'sl_status', 'is_read', 'sl_timestamp'];

	public function contacts()
	{
		return $this->hasOne('app\Models\Contact', 'c_number', 'sl_number');
	}
}