<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiteSetting extends Model
{
	protected $table = 'site_settings';
    public $timestamps = false;
	protected $fillable = [
        'background_color',
        'font_color',
        'welcome_text',
        'verbiage_text',
        'user_id',
		 	 
    ];
}
