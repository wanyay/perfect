<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SupplierCredit extends Model
{
    protected $table = "supplier_credits";

    protected $fillable = ['id','supplier_id','is_payback','amount','remark'];
}
