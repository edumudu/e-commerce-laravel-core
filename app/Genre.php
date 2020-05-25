<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
  protected $fillable = ['genre'];

  public function products()
  {
    return $this->hasMany(Product::class);
  }
}
