<?php

namespace App\Http\Requests\Frontend;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Validator;
class UpdateUserPassword extends FormRequest
{
   

    public function rules()
    {
        return [
            'old_password'    => [
                'required',
            ],
            
			'password' => ['required', 'regex:/^.*(?=.{3,})(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[\d\X])(?=.*[!$#%@]).*$/', 'min:6',],
            'confirm_password'   => [
                'required','same:password',
            ] 
           
        ];
    }
	
	public function messages()
    {
		//$messages = ['priority.name.*' => 'Test go'];
		
		return [
          'password.regex' => 'Your password must contain 1 lower case character 1 upper case character one number and One special character.',
        ];
			 
		 
		  
		return $messages;
    }
}
