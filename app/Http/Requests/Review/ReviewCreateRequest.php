<?php

namespace App\Http\Requests\Review;

use App\Review;
use Illuminate\Foundation\Http\FormRequest;
use App\Traits\FormRequestMessage;

class ReviewCreateRequest extends FormRequest
{
  use FormRequestMessage;

  /**
   * Determine if the user is authorized to make this request.
   *
   * @return bool
   */
  public function authorize()
  {
    $product = $this->route('product');

    return $this->user->can('create', [Review::class, $product]);
  }

  /**
   * Get the validation rules that apply to the request.
   *
   * @return array
   */
  public function rules()
  {
    return [
      'review'  => 'required|string',
      'rating'  => 'required|numeric|min:1|max:5'
    ];
  }
}
