<?php

namespace App\Http\Controllers;

use App\Inventory;

use App\Sale;

use App\SaleItem;

use App\Item;

class InventoryController extends Controller
{
    public function show($id)
    {
        $item = Item::with(['unit','producttype'])->findOrfail($id);
        $inventories = Inventory::orderBy('created_at', 'decs')->where('item_id', '=', $id)->paginate(5);
        return view('inventory.show', compact('inventories', 'item'));
    }

    public function printOut($id)
    {
//        $sale = Sale::with('customer')->findOrFail($id);
//        $saleitems = SaleItem::with('item')->where('sale_id', '=', $sale->id)->get();
        return \PDF::loadView('test')->setPaper('a4')->stream("invoice.pdf");

//        return view('sale.invoice', compact('sale', 'saleitems'));
    }
}
