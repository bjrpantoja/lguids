<?php

namespace app\Models;

use Hash;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract,
									 CanResetPasswordContract
{
	use Authenticatable, CanResetPassword;

    protected $table 		= 'h_users';
    protected $primaryKey 	= 'u_id';
    protected $hidden 		= ['u_password'];
    protected $fillable 	= ['u_fname', 'u_mname', 'u_lname', 'u_username', 'u_password', 'u_number', 'is_updated', 'is_active', 'is_admin', 'created_at', 'updated_at'];

    public function getAuthPassword()
    {
    	return $this->u_password;
    }

	public function setUpasswordAttribute($value) 
	{
		$this->attributes['u_password'] = Hash::make($value);
	}

	public function setUfnameAttribute($value) 
	{
		$this->attributes['u_fname'] = ucwords($value);
	}

	public function setUmnameAttribute($value) 
	{
		$this->attributes['u_mname'] = ucwords($value);
	}
	
	public function setUlnameAttribute($value) 
	{
		$this->attributes['u_lname'] = ucwords($value);
	}

	public function logs()
	{
		return $this->hasOne('app\Models\UserLog', 'u_id', 'u_id')->orderBy('ul_login_time', 'desc')->skip(1);
	}
}