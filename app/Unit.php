<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    protected $table = 'units';

    protected $fillable = ['code','desp'];

    public function item()
    {
      return $this->hasMany('App\Item');
    }
}
