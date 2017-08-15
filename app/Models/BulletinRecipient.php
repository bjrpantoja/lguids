<?php

namespace app\Models;

use Illuminate\Database\Eloquent\Model;

class BulletinRecipient extends Model
{
    protected $table 		= 'h_bulletin_recipients';
    protected $primaryKey 	= 'blr_id';
    protected $fillable 	= ['bl_id', 'c_id', 'blr_status'];
}