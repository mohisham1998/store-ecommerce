<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'slug' => 'required|unique:categories,slug,'.$this -> id,
            'photo' => 'required_without:id|mimes:jpg,jpeg,png',
            'main_category' => 'required_with:child'
        ];
    }


    public function messages() {
        return [

        ];
    }

}
