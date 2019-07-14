<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductType extends Model
{
    protected $table = 'product_types';

    protected $fillable = ['code','desp'];

    public function item()
    {
      return $this->hasMany('App\Item');
    }
}
