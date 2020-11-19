<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmailTemplateRequest extends FormRequest
{
   

    public function rules()
    {
        return [
            'title' => [
                'required',
            ],
            'subject'    => [
                'required',
            ],
            'description'    => [
                'required',
            ],
        ];
    }
}
