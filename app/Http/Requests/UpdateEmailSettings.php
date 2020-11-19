<?php
namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Validator;

class UpdateEmailSettings extends FormRequest
{
   /*  public function authorize()
    {
        return \Gate::allows('user_create');
    }
 */
    public function rules()
    {
        return [
            'smtp_host'     => [
                'required',
            ],
			'smtp_port'     => [
                'required',
            ],
            'smtp_user'  => [
				'required',
            ],
			'smtp_password' => [
				'required'
			],
			'from_email*' => [
				'required','email',
			]
        ];
    }
	
}
