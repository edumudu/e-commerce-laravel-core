<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use App\Traits\FormRequestMessage;

class UserRegisterRequest extends FormRequest
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
            'name'     => 'required|string|max:255',
            'cep'      => 'required|string|max:255',
            'phone'    => 'required|string|max:255',
            'cpf'      => 'required|string|max:255',
            'apto'     => 'nullable|string|max:10',
            'number'   => 'required|string|max:10',
            'email'    => 'required|string|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed'
        ];
    }
}
