<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreCategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'description' => 'required|max:255|min:4|unique:categories,description',
        ];
    }

    public function attributes()
    {
        return[
            'description' => "descripción de la categoría"
        ];
    }

    public function messages()
    {
        return[
            'description.required' => "Debe ingresar la descripción de la categoría"
        ];
    }

    
    
}

