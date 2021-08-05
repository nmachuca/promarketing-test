<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GameStoreRequest extends FormRequest
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
            'name' => 'required|string|min:3|max:50',
            'url' => 'required|string|min:13|max:255',
            'description' => 'nullable|string',
            'have_image' => 'required|boolean',
            'image' => 'required_unless:have_image,false|image',
            'status' => 'required|boolean'
        ];
    }
}
