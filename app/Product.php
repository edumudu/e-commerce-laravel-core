<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
  protected $table = 'tb_products';

  protected $fillable = ['name', 'estoque', 'price', 'img_folder', 'tipe_ref', 'genre_ref'];

  public $timestamps = false;
}
