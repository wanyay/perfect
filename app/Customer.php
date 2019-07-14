<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = 'customers';

    protected $fillable = ['name','phone','address'];

    public function sale()
    {
      return $this->belongsTo('App\Sale');
    }
}
