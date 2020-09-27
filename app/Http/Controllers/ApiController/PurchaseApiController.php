<?php

namespace App\Http\Controllers\ApiController;

use App\Http\Controllers\Controller;

use App\Http\Resources\PurchaseResource;
use App\Inventory;
use App\Item;
use App\Purchase;
use App\PurchaseItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Response;

class PurchaseApiController extends Controller
{

  public function __construct()
  {

  }

  public function getItems()
  {
    return Response::json(Item::all(),200);
  }

    public function getPurchaseList(Request $request)
    {
        $sales = Purchase::with(['supplier' => function($query) use ($request) {
            $query->where('name', 'like', "%" . $request->search . "%");
        }])
            ->where(function($query) use ($request) {
                $query->where('created_at', 'like', "%" . $request->search . "%")
                    ->orwhere('code', 'like', "%" . $request->search . "%");
            })->orWhereHas('supplier', function ($query) use ($request) {
                $query->where('name', "like", "%" . $request->search . "%");
            })
            ->orderBy('created_at', 'desc')
            ->paginate($request->get('per-page', 10));
        return PurchaseResource::collection($sales);
    }

  public function getPurchaseItem($id)
  {
    $purchaseitems = PurchaseItem::with('item')->where('purchase_id','=',$id)->get();
    $data  = [];
    foreach ($purchaseitems as $purchaseitem) {
        $obj = [
          'id' => $purchaseitem->item->id,
          'code' => $purchaseitem->item->code,
          'name' => $purchaseitem->item->name,
          'price' => $purchaseitem->price,
          'cost' =>$purchaseitem->cost,
          'qty' => $purchaseitem->qty
        ];
        array_push($data,$obj);
    }
    return Response::json($data,200);
  }

  public function delete(Request $request)
  {
      try {
          DB::beginTransaction();
          $purchase = Purchase::findOrFail($request->id);
          $purchaseItems = PurchaseItem::where('purchase_id', $request->id)->get();
          foreach ($purchaseItems as $purchaseItem) {
              $inventories = new Inventory;
              $i = Item::findOrFail($purchaseItem->item_id);
              $inventories->item_id = $purchaseItem->item_id;
              $inventories->in_out_qty = 0 - $purchaseItem->qty;
              $inventories->remark = 'Purchase Delete in ' . $purchase->code;
              $inventories->save();
              $i->qty = $i->qty - $purchaseItem->qty;
              $i->update();
          }
          Purchase::destroy($request->id);
          PurchaseItem::where('purchase_id', $request->id)->delete();
          DB::commit();
          return response()->json(["message" => "success"], 200);
      } catch (\Exception $e) {
          DB::rollBack();
          return response()->json([ "message" => $e ], 500);
      }
  }
}
