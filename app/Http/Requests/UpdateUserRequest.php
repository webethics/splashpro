<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
   

    public function rules()
    {
		return [
			'first_name'     => [
				'required',
			], 
			'last_name'     => [
				'required',
			]
		];
       
    }
	
	 public function messages()
    {
        return [
            'mobile_number.regex' => 'Your Mobile Number should be minimum 9 digits.',
            'mobile_number.min' => 'fhfgs.',
        ];
    }
	
	
}
