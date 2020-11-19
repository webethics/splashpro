<?php

namespace App\Http\Requests\Frontend;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Validator;
class UpdateUserProfile extends FormRequest
{
   

    public function rules()
    {
        return [
             'first_name'     => [
                'required',
            ],
			'last_name'     => [
                'required',
            ], 
			'username*' => [
				'required','min:6'
			]
        ];
    }
}
