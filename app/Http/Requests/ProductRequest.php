<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'name'         => 'required|string|max:255',
            'inventory'    => 'required|numeric|min:1',
            'price'        => 'required|numeric|min:1',
            'genre'        => 'required|numeric|min:1|exists:genres,id',
            'photos'       => 'array',
            'photos.*'     => 'image',
            'categories'   => 'required|array',
            'categories.*' => 'required|numeric|distinct|min:1|exists:categories,id'
        ];
    }
}
