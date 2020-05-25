<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
  protected $fillable = ['genre'];

  public function getRouteKeyName()
  {
    return 'name';
  }

  public function products()
  {
    return $this->hasMany(Product::class);
  }
}
