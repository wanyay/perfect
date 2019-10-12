<?php

namespace App\Imports;

use App\Price;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class PriceCsvImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return Model|Model[]|null
     */
    public function model(array $row)
    {
        return Price::create([
            "item_id" => (int) $row['id'],
            "wholesale_price" => (int) $row['wholesale_price'],
            "retail_price" => (int) $row['price'],
            "cost" => (int) $row["cost"],
            "company_cost" => (int) 0,
            "qty" => (int) $row["qty"]
        ]);
    }
}
