<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductFormRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string',
            'price' => 'required|integer',
            'description' => 'nullable|string',
            'image'=>'nullable|image'
        ];
    }
}
