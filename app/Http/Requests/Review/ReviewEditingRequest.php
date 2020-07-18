<?php

namespace App\Http\Requests\Review;

use Illuminate\Foundation\Http\FormRequest;
use App\Traits\FormRequestMessage;
use Illuminate\Support\Facades\Gate;

class ReviewEditingRequest extends FormRequest
{
  use FormRequestMessage;

  /**
   * Determine if the user is authorized to make this request.
   *
   * @return bool
   */
  public function authorize()
  {
    return Gate::forUser($this->user)->allows('edit-product-review');
  }

  /**
   * Get the validation rules that apply to the request.
   *
   * @return array
   */
  public function rules()
  {
    return [
      'product' => 'required|numeric|min:1|exists:products,id',
      'review'  => 'required|string',
      'rating'  => 'required|numeric|min:1|max:5'
    ];
  }
}
