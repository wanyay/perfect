<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    protected $table = "expenses";

    protected $fillable = ['id','category_id','amount'];

    public function category()
    {
      return $this->belongsTo(Category::class);
    }
}
