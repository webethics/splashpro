<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CmsPage extends Model
{
	public $timestamps = false;
    protected $table = 'cms_pages';
	 
	protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'title',
        'slug',
        'content',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
	
}
