<?php

namespace app\Models;

use Illuminate\Database\Eloquent\Model;

class ContactGroup extends Model
{
    protected $table 		= 'h_contact_groups';
    protected $primaryKey 	= 'cg_id';
	protected $fillable 	= ['c_id', 'g_id'];

	public function contacts()
	{
		return $this->hasMany('app\Models\Contact', 'c_id', 'c_id');
	}
}