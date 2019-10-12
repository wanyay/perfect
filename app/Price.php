<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Price extends Model
{
    protected $fillable = [
        'item_id',
        'wholesale_price',
        'retail_price',
        'cost',
        'company_cost',
        'qty'
    ];

    public function item()
    {
        return $this->belongsTo(Item::class);
    }
}
