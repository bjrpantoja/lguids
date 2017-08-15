<?php

namespace app\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $table 		= 'h_contacts';
    protected $primaryKey 	= 'c_id';
	protected $fillable 	= ['c_fname', 'c_mname', 'c_lname', 'c_number', 'c_agency', 'c_position', 'is_active'];

	public function groups()
	{
		return $this->belongsToMany('app\Models\Group', 'h_contact_groups', 'c_id', 'g_id')->orderBy('cg_id');
	}

	public function setCfnameAttribute($value)
	{
		$this->attributes['c_fname'] = ucwords($value);
	}

	public function setCmnameAttribute($value)
	{
		$this->attributes['c_mname'] = ucwords($value);
	}

	public function setClnameAttribute($value)
	{
		$this->attributes['c_lname'] = ucwords($value);
	}
}