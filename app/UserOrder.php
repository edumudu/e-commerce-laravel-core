<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserOrder extends Model
{
  protected $fillable = ['reference', 'pagseguro_code', 'pagseguro_status', 'items'];

  protected $hidden = ['user_id'];

  public function user()
  {
    return $this->belongsTo(User::class);
  }
}
