<?php

namespace App\Traits;

trait FormRequestMessage
{
  public function messages()
    {
      return [
        'required' => ':attribute is required',
        'string'   => ':attribute must be a valid string',
        'numeric'  => ':attribute must be a valid number',
        'email'    => ':attribute must be a valid email',
        'boolean'  => ':attribute must be a boolean',
        'array'    => ':attribute must be a valid array',
        'image'    => ':attribute must be a valid image',
        'min'      => ':attribute must be more than :min characters',
        'max'      => ':attribute must be less than :max characters',
        'distinct' => ':attribute must not have any duplicate values',
      ];
    }  
}
