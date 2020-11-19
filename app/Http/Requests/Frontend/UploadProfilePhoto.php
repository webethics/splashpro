<?php

namespace App\Http\Requests\Frontend;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class UploadProfilePhoto extends FormRequest
{
   

    public function rules()
    {
        return [
           // 'upload_profile_file' => 'required|image|mimes:jpeg,png,jpg'
           // 'upload_profile_file' => 'required|image|mimes:jpeg,png,jpg'
        ];
    }
	
	
	
}
