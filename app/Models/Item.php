<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $table = "items";

    protected $fillable = ['code','name','cost','price','qty','unit_id','producttype_id'];

    public function unit()
    {
      return $this->belongsTo(Unit::class);
    }

    public function producttype()
    {
      return $this->belongsTo(ProductType::class);
    }
    public function saleitem()
    {
        return $this->hasMany(SaleItem::class);
    }

}
