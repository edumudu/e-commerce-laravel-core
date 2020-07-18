<?php

namespace App\Http\Requests\Review;

use Illuminate\Foundation\Http\FormRequest;
use App\Traits\FormRequestMessage;

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
    $review = $this->route('review');

    return $this->user->can('update', $review);
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
