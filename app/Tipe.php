<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tipe extends Model
{
  protected $table = 'tb_tipes';

  protected $fillable = ['tipe'];
}
