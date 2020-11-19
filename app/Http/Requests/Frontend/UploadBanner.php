<?php

namespace App\Http\Requests\Frontend;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class UploadBanner extends FormRequest
{
   

    public function rules()
    {
        return [
           // 'upload_banner_file' => 'required|image|mimes:jpeg,png,jpg|max:2024'
           // 'upload_banner_file' => 'required|image|mimes:jpeg,png,jpg|max:2024'
        ];
    }
	
	
	
}