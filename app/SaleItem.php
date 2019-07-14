<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SaleItem extends Model
{
    protected $table = 'sale_items';

    protected $fillable = ['sale_id','item_id','cost','price','total_profix','total_cost','total_price','qty'];

    public function item()
    {
    	return $this->belongsTo('App\Item');
    }
}
