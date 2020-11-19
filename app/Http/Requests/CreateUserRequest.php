<?php
namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Validator;

class createUserRequest extends FormRequest
{
   /*  public function authorize()
    {
        return \Gate::allows('user_create');
    }
 */
    public function rules()
    {
        return [
             'first_name'     => [
                'required',
            ],
			'last_name'     => [
                'required',
            ], 
			'email*' => [
				'required','email','unique:users'
			],
			
			'password' => ['required', 'regex:/^.*(?=.{3,})(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[\d\X])(?=.*[!$#%@]).*$/', 'min:6',
			],

			'password_confirmation'   => [
                'required','same:password',
            ] ,
			'terms_condition'   => [
                'required',
            ] 
			
        ];
    }
	public function messages()
    {
		return [
          /* 'password.regex' => 'Your password must contain 1 lower case character 1 upper case character one number and One special character.', */
		  'mobile_number.regex' => 'Your Mobile Number should be minimum 9 digits.',
          'mobile_number.min' => 'fhfgs.',
		  'login_password.regex' => 'Your password must contain 1 lower case character 1 upper case character one number and One special character.',
        ];
			 
    }
	
}
