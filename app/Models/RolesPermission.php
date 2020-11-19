<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RolesPermission extends Model
{
	protected $table = 'roles_permission';
    public $timestamps = false;
	protected $fillable = [
        'role_id',
        'permission_id',
    ];
	
	
}
