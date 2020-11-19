<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Plan extends Model
{
	use SoftDeletes;

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'cost',
		'insurance_cover',
		'locking_period',
		'description'
    ];

    public function user()
    {
    	return $this->hasMany('App\Models\User','plan_id');
    }
    
}
