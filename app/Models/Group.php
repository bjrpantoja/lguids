<?php

namespace app\Models;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $table 		= 'h_groups';
    protected $primaryKey 	= 'g_id';
	protected $fillable 	= ['g_name', 'is_active'];

	public function contact_groups()
	{
		return $this->hasMany('app\Models\ContactGroup', 'g_id', 'g_id');
	}
}