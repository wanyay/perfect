<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $table = "items";

    protected $fillable = ['code','name','unit_id','producttype_id'];

    public function unit()
    {
        return $this->belongsTo('App\Unit');
    }

    public function getPriceAttribute()
    {
        return $this->prices()->latest()->first()->retail_price;
    }

    public function getQtyAttribute()
    {
        return $this->prices()->sum('qty');
    }


    public function producttype()
    {
        return $this->belongsTo('App\ProductType');
    }
    public function saleitem()
    {
        return $this->hasMany('App\SaleItem');
    }

    public function prices()
    {
        return $this->hasMany(Price::class);
    }
}
