<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = "categories";

    protected $fillable = ['id','name'];

    public function expense()
    {
      return $this->hasMany(Expense::class);
    }
}
