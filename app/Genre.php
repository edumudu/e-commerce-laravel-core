<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
  protected $table = 'tb_genres';

  protected $fillable = ['genre'];

  public $timestamps = false;
}
