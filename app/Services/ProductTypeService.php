<?php
namespace App\Services;

use App\Models\ProductType;

class ProductTypeService extends BaseService
{
    public function __construct(ProductType $model)
    {
        parent::__construct($model);
    }
}
