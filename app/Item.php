<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $table = "items";

    protected $fillable = ['code','name','cost','price','qty','unit_id','producttype_id'];

    public function unit()
    {
      return $this->belongsTo('App\Unit');
    }

    public function producttype()
    {
      return $this->belongsTo('App\ProductType');
    }
    public function saleitem()
    {
        return $this->hasMany('App\SaleItem');
    }
    
}
