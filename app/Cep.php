<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cep extends Model
{
    protected $fillable = ['cep'];

    public function address()
    {
      return json_decode(file_get_contents('https://viacep.com.br/ws/' . $this->cep . '/json/'));
    }

    public function users()
    {
      return $this->hasMany(User::class);
    }
}
