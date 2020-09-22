<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;

use App\Customer;

use App\Sale;

use App\SaleItem;

use App\Item;

use App\Inventory;

use Redirect;

use App\Credit;

use DB;

class SaleController extends Controller
{
    public function index()
    {
        $sales = Sale::with('customer')->orderBy('created_at', 'desc')->get();
        return view('sale.index', compact('sales'));
    }

    public function create()
    {
        $invoiceNo = (new Sale())->generateInvoiceCode();
        return view('sale.create', compact('invoiceNo'));
    }

    public function edit($id)
    {
        $customers = Customer::pluck('name', 'id');
        $sale = Sale::with('customer')->findOrFail($id);
        ($sale->payment_type == 'credit') ? $customer_selected = [$sale->customer->id] : $customer_selected = null ;
        return view('sale.edit', compact('sale', 'customers', 'customer_selected'));
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $sale = new Sale();
            $sale->code= $request->code;
            $sale->payment_type = $request->payment_type;
            $sale->customer_id = $request->customer_id;
            $sale->cash = $request->cash;
            $sale->discount = $request->discount;
            $sale->profit = $request->profit - $request->discount;
            $sale->total = $request->total - $request->discount;
            $sale->created_at = $request->created_at;
            if ($request->payment_type == 'credit') {
                $sale->credit_due_date = $request->credit_due_date;
            }
            $sale->save();

            if ($request->payment_type == 'credit') {
                Credit::create([
                    'customer_id' => $request->customer_id,
                    'amount'=> $request->total - ($request->cash + $request->discount),
                    'is_payback' => 0,
                    'remark'=>'Credit in '.$request->code
                ]);
            }
        } catch (Exception $e) {
            DB::rollback();
            return Redirect::to('/sales/create')->withErrors($e->getMessage())->withInput();
        }

        try {
            $items = json_decode($request->saleitems);
            foreach ($items as $item) {
                $saleitem = new SaleItem;
                $saleitem->sale_id = $sale->id;
                $saleitem->item_id = $item->id;
                $saleitem->cost    = $item->cost;
                $saleitem->price   = $item->price;
                $saleitem->total_cost = $item->cost * $item->qty;
                $saleitem->total_price = $item->price * $item->qty;
                $saleitem->total_profix = ($item->price - $item->cost) * $item->qty;
                $saleitem->qty     = $item->qty;
                $saleitem->created_at = $request->created_at;
                $saleitem->updated_at = $request->created_at;
                $saleitem->save();
                $inventories = new Inventory;
                $i = Item::findOrFail($item->id);
                $inventories->item_id = $item->id;
                $inventories->in_out_qty = 0 - $item->qty;
                $inventories->remark = 'Sale in '.$sale->code;
                $inventories->save();
                $i->qty = $i->qty - $item->qty;
                $i->update();
            }
        } catch (Exception $e) {
            // Back to form with errors
            DB::rollback();
            return Redirect::to('/sales/create')->withErrors($e->getMessage())->withInput();
        }
        DB::commit();
        // flash()->success('Success','New Sale has been added.');
        $sale = Sale::with('customer')->findOrFail($sale->id);
        $saleitems = SaleItem::with('item')->where('sale_id', '=', $sale->id)->get();
        return view('sale.invoice', compact('sale', 'saleitems'));
    }

    public function update($id, Request $request)
    {
        $old_saleitem = SaleItem::where('sale_id', $id)->pluck('qty', 'item_id');
        $array_old_saleitem = $old_saleitem->toArray();
        DB::beginTransaction();
        try {
            SaleItem::where('sale_id', $id)->delete();
        } catch (Exception $e) {
            DB::rollback();
            return Redirect::back()->withErrors($e->getMessage())->withInput();
        }

        try {
            $sale = Sale::findOrFail($id);
            $sale->code = $request->code;
            $sale->customer_id = $request->customer_id;
            $sale->payment_type = $request->payment_type;
            $sale->profit = $request->profix;
            $sale->cash = $request->cash;
            $sale->total = $request->total;
            $sale->update();
        } catch (Exception $e) {
            DB::rollback();
            return Redirect::to('/sales/create')->withErrors($e->getMessage())->withInput();
        }

        try {
            $items = json_decode($request->saleitems);
            foreach ($items as $item) {
                $i = Item::findOrFail($item->id);
                $saleitem = new SaleItem;
                $saleitem->sale_id     = $sale->id;
                $saleitem->item_id     = $item->id;
                $saleitem->cost        = $item->cost;
                $saleitem->price       = $item->price;
                $saleitem->total_cost  = $item->cost * $item->qty;
                $saleitem->total_price = $item->price * $item->qty;
                $saleitem->total_profix = ($item->price - $item->cost) * $item->qty;
                $saleitem->qty         = $item->qty;
                $saleitem->save();
                if (!empty($array_old_saleitem[$item->id])) {
                    if ($item->qty != $array_old_saleitem[$item->id]) {
                        if ($item->qty < $array_old_saleitem[$item->id]) {
                            $i->qty = $i->qty + ($array_old_saleitem[$item->id] - $item->qty);
                        } else {
                            $i->qty = $i->qty - ($item->qty - $array_old_saleitem[$item->id]);
                        }
                        $i->update();
                        $inventories = new Inventory;
                        $inventories->item_id = $item->id;
                        $inventories->remark = 'Edit in '.$sale->code;
                        $inventories->in_out_qty = $array_old_saleitem[$item->id] - $item->qty;
                        $inventories->save();
                    }
                } else {
                    $inventories = new Inventory;
                    $inventories->item_id = $item->id;
                    $inventories->in_out_qty = 0 - $item->qty;
                    $inventories->remark = 'Sale in '.$sale->code;
                    $inventories->save();
                    $i->qty = $i->qty - $item->qty;
                    $i->update();
                }
            }
        } catch (Exception $e) {
            // Back to form with errors
            DB::rollback();
            return Redirect::to('/sales/create')->withErrors($e->getMessage())->withInput();
        }
        DB::commit();
        flash()->success('Success', 'Sale has been edited.');
        return redirect()->route('sales.index');
    }

    public function destroy($id)
    {
        $sale = Sale::findOrFail($id);
        $saleitems = SaleItem::where('sale_id', $id)->get();
        foreach ($saleitems as $saleitem) {
            $inventories = new Inventory;
            $i = Item::findOrFail($saleitem->item_id);
            $inventories->item_id = $saleitem->item_id;
            $inventories->in_out_qty = $saleitem->qty;
            $inventories->remark = 'Delete in '.$sale->code;
            $inventories->save();
            $i->qty = $i->qty + $saleitem->qty;
            $i->update();
        }
        Sale::destroy($id);
        try {
            SaleItem::where('sale_id', $id)->delete();
        } catch (Exception $e) {
            return $e;
        }
        return $sale;
    }
}
