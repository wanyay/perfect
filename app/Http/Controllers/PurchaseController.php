<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;

use App\Supplier;

use App\Purchase;

use App\PurchaseItem;

use App\SupplierCredit;

use App\Inventory;

use App\Item;

use Redirect;

class PurchaseController extends Controller
{

    public function index()
    {
        $purchases = Purchase::with('supplier')->orderBy('created_at', 'desc')->get();
        return view('purchase.index', compact('purchases'));
    }

    public function create()
    {
        return view('purchase.create');
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $purchase = Purchase::create(['code' => $request->code, 'payment_type' => $request->payment_type, 'supplier_id' => $request->supplier_id, 'cash' => $request->cash, 'total' => $request->total]);
            if ($request->payment_type == 'credit') {
                SupplierCredit::create(['supplier_id' => $request->supplier_id, 'amount' => $request->total - $request->cash, 'is_payback' => 0, 'remark' => 'Credit in ' . $request->code]);
            }
        } catch (\Exception $e) {
            DB::rollback();
            return Redirect::to('/purchases/create')->withErrors($e->getMessage())->withInput();
        }

        try {
            $purchasedatas = json_decode($request->purchaseitems);
            foreach ($purchasedatas as $purchasedata) {
                $purchaseitem = new PurchaseItem;
                $purchaseitem->purchase_id = $purchase->id;
                $purchaseitem->item_id = $purchasedata->id;
                $purchaseitem->cost = $purchasedata->cost;
                $purchaseitem->price = $purchasedata->price;
                $purchaseitem->total_cost = $purchasedata->cost * $purchasedata->qty;
                $purchaseitem->total_price = $purchasedata->price * $purchasedata->qty;
                $purchaseitem->qty = $purchasedata->qty;
                $purchaseitem->save();
                $item = Item::findOrFail($purchasedata->id);

                if ($item->price != $purchasedata->price || $item->cost != $purchasedata->cost) {
                    $item->price = $purchasedata->price;
                    $item->cost = $purchasedata->cost;
                    $item->update();
                }

                $inventories = new Inventory;
                $inventories->item_id = $purchasedata->id;
                $inventories->in_out_qty = 0 + $purchasedata->qty;
                $inventories->remark = 'Purchase in ' . $purchase->code;
                $inventories->save();
                $item->qty = $item->qty + $purchasedata->qty;
                $item->update();
            }

        } catch (\Exception $e) {
            // Back to form with errors
            DB::rollback();
            return Redirect::to('/purchases/create')->withErrors($e->getMessage())->withInput();
        }
        DB::commit();
        flash()->success('Success', 'New Purchase has been added.');
        return redirect()->action('PurchaseController@index');
    }

    public function edit($id)
    {
        $suppliers = Supplier::pluck('name', 'id');
        $purchase = Purchase::with('supplier')->findOrFail($id);
        ($purchase->payment_type) ? $supplier_selected = [$purchase->supplier->id] : $customer_selected = null;
        return view('purchase.edit', compact('purchase', 'suppliers', 'supplier_selected'));
    }

    public function update($id, Request $request)
    {
        $old_PurchaseItem = PurchaseItem::where('purchase_id', $id)->pluck('qty', 'item_id');
        $array_old_PurchaseItem = $old_PurchaseItem->toArray();
        DB::beginTransaction();
        try {

            PurchaseItem::where('purchase_id', $id)->delete();

        } catch (\Exception $e) {
            DB::rollback();
            return Redirect::back()->withErrors($e->getMessage())->withInput();
        }

        try {

            $purchase = Purchase::findOrFail($id);
            $purchase->code = $request->code;
            $purchase->supplier_id = $request->supplier_id;
            $purchase->payment_type = $request->payment_type;
            $purchase->cash = $request->cash;
            $purchase->total = $request->total;
            $purchase->update();

        } catch (\Exception $e) {
            DB::rollback();
            return Redirect::to('/sales/create')->withErrors($e->getMessage())->withInput();
        }

        try {
            $items = json_decode($request->purchaseitems);
            foreach ($items as $item) {
                $i = Item::findOrFail($item->id);
                $PurchaseItem = new PurchaseItem;
                $PurchaseItem->purchase_id = $purchase->id;
                $PurchaseItem->item_id = $item->id;
                $PurchaseItem->cost = $item->cost;
                $PurchaseItem->price = $item->price;
                $PurchaseItem->total_cost = $item->cost * $item->qty;
                $PurchaseItem->total_price = $item->price * $item->qty;
                $PurchaseItem->qty = $item->qty;
                $PurchaseItem->save();

                if ($i->price != $item->price || $i->cost != $item->cost) {
                    $i->price = $item->price;
                    $i->cost = $item->cost;
                    $i->update();
                }

                if (!empty($array_old_PurchaseItem[$item->id])) {
                    if ($item->qty != $array_old_PurchaseItem[$item->id]) {
                        // if Old qty is greater than edited qty
                        if ($item->qty < $array_old_PurchaseItem[$item->id]) {
                            $i->qty = $i->qty - ($array_old_PurchaseItem[$item->id] - $item->qty);
                            $i->update();
                            $inventories = new Inventory;
                            $inventories->item_id = $item->id;
                            $inventories->remark = 'Edit in ' . $purchase->code;
                            $inventories->in_out_qty = 0 - ($array_old_PurchaseItem[$item->id] - $item->qty);
                            $inventories->save();
                        } else {
                            $i->qty = $i->qty + ($item->qty - $array_old_PurchaseItem[$item->id]);
                            $i->update();
                            $inventories = new Inventory;
                            $inventories->item_id = $item->id;
                            $inventories->remark = 'Edit in ' . $purchase->code;
                            $inventories->in_out_qty = $item->qty - $array_old_PurchaseItem[$item->id];
                            $inventories->save();
                        }

                    }

                } else {
                    $inventories = new Inventory;
                    $inventories->item_id = $item->id;
                    $inventories->in_out_qty = 0 - $item->qty;
                    $inventories->remark = 'Sale in ' . $purchase->code;
                    $inventories->save();
                    $i->qty = $i->qty + $item->qty;
                    $i->update();
                }


            }

        } catch (\Exception $e) {
            // Back to form with errors
            DB::rollback();
            return Redirect::to('/purchases/create')->withErrors($e->getMessage())->withInput();
        }
        DB::commit();
        flash()->success('Success', 'Sale has been edited.');
        return redirect()->route('purchases.index');

    }

    public function destroy($id)
    {
        $purchase = Purchase::findOrFail($id);
        $purchaseitems = PurchaseItem::where('purchase_id', $id)->get();
        foreach ($purchaseitems as $purchaseitem) {
            $inventories = new Inventory;
            $i = Item::findOrFail($purchaseitem->item_id);
            $inventories->item_id = $purchaseitem->item_id;
            $inventories->in_out_qty = 0 - $purchaseitem->qty;
            $inventories->remark = 'Purchase Delete in ' . $purchase->code;
            $inventories->save();
            $i->qty = $i->qty - $purchaseitem->qty;
            $i->update();
        }
        Purchase::destroy($id);
        PurchaseItem::where('purchase_id', $id)->delete();
        return $purchase;
    }

    public function print_out($id)
    {
        $purchase = Purchase::findOrFail($id);
        $purchaseitems = PurchaseItem::where('purchase_id', $id)->get();

        return view('purchase.invoice', compact('purchase', 'purchaseitems'));
    }
}
