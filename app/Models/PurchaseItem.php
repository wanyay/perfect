<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PurchaseItem extends Model
{
  protected $table = 'parchase_items';

  protected $fillable = ['purchase_id','item_id','cost','price','total_cost','total_price','qty'];

  public function item()
  {
    return $this->belongsTo(Item::class);
  }
}
