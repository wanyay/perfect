<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Item;

use App\Inventory;

use Illuminate\Support\Facades\DB;
use \Milon\Barcode\DNS1D;

use App\Unit;

use App\ProductType;

class ItemController extends Controller
{
    public function index()
    {
        $items = Item::all();
        return view('item.index', compact('items'));
    }

    public function create()
    {
        $units = Unit::pluck('code', 'id');
        $types = ProductType::pluck('code', 'id');
        return view('item.create', compact('units', 'types'));
    }

    public function store(Request $request)
    {

        try {
            DB::enableQueryLog();
            $item = Item::create($request->all());

            $inventory = Inventory::create([
                'item_id' => $item->id,
                'in_out_qty'=> $request->qty,
                'remark' => "Manual Create of Quantity"
            ]);

            $item->prices()->create([
                'qty' => $request->qty,
                'wholesale_price' => $request->wholesale_price,
                'retail_price' => $request->retail_price,
                'cost' => $request->cost,
                'company_cost' => $request->company_cost ? $request->company_cost : 0
            ]);

            $item ?
                flash()->success('Success', 'New Item has been added.') :
                flash()->error('Error', 'Something is wrong!');
            DB::commit();

            return redirect()->action('ItemController@index');
        } catch (\Exception $exception) {
            return abort(500);
        }
    }

    public function edit($id)
    {
        $item = Item::with(['unit','producttype'])->findOrfail($id);
        $units = Unit::pluck('code', 'id');
        $types = ProductType::pluck('code', 'id');
        $unit_selected = [$item->unit->id];
        $type_selected = [$item->producttype->id];
        return view('item.edit', compact('item', 'units', 'types', 'unit_selected', 'type_selected'));
    }

    public function update($id, Request $request)
    {
        $item = Item::findOrFail($id);

        // process inventory
        if ($request->qty != $item->qty) {
            $inventories = new Inventory;
            $inventories->item_id = $id;
            $inventories->in_out_qty = $request->qty - $item->qty;
            $inventories->remark = 'Manual Edit of Quantity';
            $inventories->save();
        }
        // process update
        $item->update($request->all());

        flash()->success('Updated', 'Item has been updated.');

        return redirect()->action('ItemController@index');
    }
    public function destroy($id)
    {
        $item = Item::destroy($id);
        return $item;
    }

    public function barcode($id)
    {
        $item = Item::findOrFail($id);
        return view('item.barcode', compact('item'));
    }
}
