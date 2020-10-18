<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Credit extends Model
{
    protected $table = "credits";

    protected $fillable = ['id','customer_id','is_payback','amount','remark', 'created_at'];

    public function customer()
    {
        return $this->belongsTo('App\Customer');
    }
}
