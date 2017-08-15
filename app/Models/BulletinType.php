<?php

namespace app\Models;

use Illuminate\Database\Eloquent\Model;

class BulletinType extends Model
{
    protected $table 		= 'h_bulletin_types';
    protected $primaryKey 	= 'bt_id';
    protected $fillable 	= ['bt_name', 'is_active'];

    public function bulletins()
    {
    	return $this->hasMany('app\Models\Bulletin', 'bt_id', 'bt_id')->orderBy('created_at', 'desc');
    }

    public function bulletin_count()
    {
    	return $this->bulletins()->selectRaw('bt_id, count(*) as bulletin')->groupBy('bt_id');
    }
}