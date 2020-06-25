<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cep extends Model
{
    private $address;

    protected $fillable = ['cep'];

    public function address() : object
    {
      $this->address = isset($this->address)
        ? $this->address
        : json_decode(file_get_contents('https://viacep.com.br/ws/' . $this->cep . '/json/'));

      return $this->address;
    }

    public function addresses()
    {
      return $this->hasMany(Address::class);
    }
}
