<?php

use App\Price;
use Illuminate\Database\Seeder;
use App\User;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $itemArray = csvToArray(database_path('csv/items.csv'));

        for ($i = 0; $i < count($itemArray); $i ++) {
            dd($itemArray['id']);
            $price = new Price();
            $price->item_id = $itemArray['id'];
            $price->wholesale_price = $itemArray['wholesale_price'];
            $price->retail_price = $itemArray['retail_price'];
            $price->cost = $itemArray['cost'];
            $price->company_cost = 0;
            $price->qty = $itemArray['qty'];
            $price->save();
        }
    }
}
