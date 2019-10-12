<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
  protected $table = 'parchases';

  protected $fillable = ['code','supplier_id','payment_type','cash','total'];

  public function  supplier()
  {
    return $this->belongsTo(Supplier::class);
  }
}
