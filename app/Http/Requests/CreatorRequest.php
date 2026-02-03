<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreatorRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
//            'paypal'                => 'required',
            'content_type'          => 'required',
            'old_account'           => 'required',
            'content_description'   => 'required',
            'subgenres'             => 'required',
        ];
    }
}
