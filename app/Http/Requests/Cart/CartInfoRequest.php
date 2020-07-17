<?php

namespace App\Http\Requests\Cart;

use Illuminate\Foundation\Http\FormRequest;
use App\Traits\FormRequestMessage;

class CartInfoRequest extends FormRequest
{
    use FormRequestMessage;
    
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
          'cart'   => 'array',
          'cart.*' => 'numeric|min:1'
        ];
    }
}
