<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Inventory;

use App\Sale;

use App\SaleItem;

use App\Item;

class InventoryController extends Controller
{
    public function show($id)
    {
        $item = Item::with(['unit','producttype'])->findOrfail($id);
        $inventories = Inventory::orderBy('created_at','decs')->where('item_id','=',$id)->paginate(5);
        return view('inventory.show',compact('inventories','item'));
    }
    public function print_out($id)
    {
      $sale = Sale::with('customer')->findOrFail($id);
      $saleitems = SaleItem::with('item')->where('sale_id','=',$sale->id)->get();
      return view('sale.invoice',compact('sale','saleitems'));
    }
}
