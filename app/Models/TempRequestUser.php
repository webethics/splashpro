<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TempRequestUser extends Model
{
	use SoftDeletes;
	
    protected $dates = [
        'created_at',
        'updated_at',
    ];

    protected $fillable = [
        'user_id',
        'first_name',
		'last_name',
		'email',
		'address',
		'mobile_number',
		'aadhar_number',
		'status',
		'state_id',
		'district_id',
		'description'
    ];

    protected $appends = ['full_name'];

	public function user() {
		return $this->belongsTo('App\Models\User','user_id');
	}

	public function getFullNameAttribute()
    {
        return ucfirst("{$this->first_name} {$this->last_name}");
    }
}
