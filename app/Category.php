<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = "categories";

    protected $fillable = ['id','name'];

    public function expense()
    {
        return $this->hasMany('App\Expense');
    }
}
