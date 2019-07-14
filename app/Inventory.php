<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    protected $table = "inventories";

    protected $fillable = ['item_id','in_out_qty','remark'];
}
