<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NewsarchiveRequest extends FormRequest
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
        if ($this->getMethod() == 'POST') {
            return [
                'image'     => 'required|image',
                'title'     => 'required',
                'description'=> 'required'
            ];
        }else{
            return [
                'image'     => 'sometimes|image',
                'title'     => 'required',
                'description'=> 'required'
            ];
        }
    }
}
