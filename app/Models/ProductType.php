<?php

namespace App\Models;

use Doctrine\DBAL\Query\QueryBuilder;
use Illuminate\Database\Eloquent\Model;

class ProductType extends Model
{
    protected $table = 'product_types';

    protected $fillable = ['code','desp'];

    public function item()
    {
        return $this->hasMany(Item::class);
    }

    /**
     * @param string $keyword
     *
     * @return QueryBuilder
     */

    public function search($keyword)
    {
        return $this->where('code', 'like', "%{$keyword}%")
            ->orWhere('desp', 'like', "%{$keyword}%");
    }
}
