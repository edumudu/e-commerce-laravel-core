<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
  protected $table = 'tb_reviews';

  protected $fillable = ['prod_ref', 'user_ref', 'rating', 'review', 'writed_at'];

  public $timestamps = false;
}
