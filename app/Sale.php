<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $table = 'sales';

    protected $fillable = ['code','customer_id','payment_type','profit','cash','discount','total'];

    public function customer()
    {
    	return $this->belongsTo('App\Customer');
    }
}
