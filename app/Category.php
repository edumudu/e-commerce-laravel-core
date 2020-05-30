<?php

namespace App;

use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
  use HasSlug;

  protected $fillable = ['name'];

  public function getSlugOptions() : SlugOptions
  {
      return SlugOptions::create()
          ->generateSlugsFrom('name')
          ->saveSlugsTo('slug');
  }

  public function getRouteKeyName()
  {
    return 'slug';
  }

  public function products()
  {
    return $this->belongsToMany(Product::class);
  }
}
