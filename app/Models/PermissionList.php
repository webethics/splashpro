<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PermissionList extends Model
{
    public $timestamps = false;
	protected $table = 'permission_list';
  
}
