<?php
namespace App\Services;

use App\Models\Unit;

class UnitService extends BaseService
{
    public function __construct(Unit $unit)
    {
        parent::__construct($unit);
    }
}
