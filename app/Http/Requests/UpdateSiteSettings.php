<?php
namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Validator;

class UpdateSiteSettings extends FormRequest
{
   /*  public function authorize()
    {
        return \Gate::allows('user_create');
    }
 */
    public function rules()
    {
        return [
            'site_title'     => [
                'required',
            ]/* ,
			'api_name'     => [
                'required',
            ],
            'api_key'  => [
				'required',
            ], */
        ];
    }
	
}
