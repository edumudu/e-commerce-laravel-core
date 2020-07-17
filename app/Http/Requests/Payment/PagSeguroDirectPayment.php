<?php

namespace App\Http\Requests\Payment;

use Illuminate\Foundation\Http\FormRequest;
use App\Traits\FormRequestMessage;

class PagSeguroDirectPayment extends FormRequest
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
            'token'           => 'required|string',
            'hash'            => 'required|string',
            'installment'     => 'required|string',
            'name'            => 'required|string',
            'cart'            => 'required|array',
            'cart.*'          => 'required',
            'cart.*.id'       => 'required|numeric|min:1|distinct|exists:products,id',
            'cart.*.quantity' => 'required|numeric|min:1',
            'cpf'             => 'required|string',
            'birthdate'       => 'required|date_format:d/m/Y|before:yesterday',
            'sameAsRegister'  => 'required|boolean',
            'cep'             => 'required_if:sameAsRegister,false',
            'number'          => 'required_if:sameAsRegister,false',
            'apto'            => 'nullable:sameAsRegister,false'
        ];
    }
}
