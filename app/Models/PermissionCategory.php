<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PermissionCategory extends Model
{
    public $timestamps = false;
	protected $table = 'permission_categories';
	
	public function permissionList()
    {
    	return $this->hasMany('App\Models\PermissionList','category_id');
    }
  
}
