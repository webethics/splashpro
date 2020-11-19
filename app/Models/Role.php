<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
    use SoftDeletes;

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'title',
        'slug',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
	
	public function rolePermissions()
    {
    	return $this->hasMany('App\Models\RolesPermission','role_id');
    }
	public function users() {
		return $this->HasMany(User::class);
	}
}
