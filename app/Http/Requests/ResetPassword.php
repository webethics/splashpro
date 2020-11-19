<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ResetPassword extends FormRequest
{
   

    public function rules()
    {
        return [
      
			'password' => ['required', 'regex:/^.*(?=.{3,})(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!$#%@]).*$/', 'min:6'],
            'password_confirmation'   => [
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
