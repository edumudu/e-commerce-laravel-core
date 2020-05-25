<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
  protected $fillable = ['name', 'inventory', 'price', 'slug'];

  public function genre()
  {
    return $this->belongsTo(Genre::class);
  }

  public function user()
  {
    return $this->belongsTo(User::class);
  }

  public function reviews()
  {
    return $this->hasMany(Review::class);
  }

  public function photos()
  {
    return $this->hasMany(ProductPhoto::class);
  }

  public function categories()
  {
    return $this->belongsToMany(Category::class);
  }
}
