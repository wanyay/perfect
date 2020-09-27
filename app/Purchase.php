<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
  protected $table = 'parchases';

  protected $fillable = ['code','supplier_id','payment_type','cash','total'];

    public function getDateAttribute()
    {
        return $this->created_at->format('Y-m-d');
    }

  public function  supplier()
  {
    return $this->belongsTo('App\Supplier');
  }
}
