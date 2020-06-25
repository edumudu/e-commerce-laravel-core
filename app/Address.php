<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $fillable = ['apto', 'number'];

    public function address() {
      return (object)array_merge((array)$this->cep->address(), [
        'apto' => $this->apto,
        'number' => $this->number
      ]);
    }

    public function cep()
    {
      return $this->belongsTo(Cep::class);
    }

    public function users()
    {
      return $this->hasMany(User::class);
    }
}
