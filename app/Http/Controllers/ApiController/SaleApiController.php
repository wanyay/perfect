<?php

namespace App\Http\Controllers\ApiController;

use App\Http\Controllers\Controller;
use Exception;
use App\Http\Resources\SaleResource;
use App\Inventory;
use App\Item;

use App\Sale;
use App\SaleItem;

use Illuminate\Http\Request;
use Response;

class SaleApiController extends Controller
{

  public function __construct()
  {

  }

  public function delete(Request $request)
  {
      $sale = Sale::findOrFail($request->id);
      $saleitems = SaleItem::where('sale_id', $request->id)->get();
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
      Sale::destroy($request->id);
      try {
          SaleItem::where('sale_id', $request->id)->delete();
      } catch (Exception $e) {
          return $e;
      }
      return response()->json(['status' => 'success']);
  }

  public function getSaleList(Request $request)
  {
      $sales = Sale::with(['customer' => function($query) use ($request) {
                    $query->where('name', 'like', "%" . $request->search . "%");
                }])
                ->where(function($query) use ($request) {
                    $query->where('created_at', 'like', "%" . $request->search . "%")
                        ->orwhere('code', 'like', "%" . $request->search . "%");
                })->orWhereHas('customer', function ($query) use ($request) {
                    $query->where('name', "like", "%" . $request->search . "%");
                })
                ->orderBy('created_at', 'desc')
                ->paginate($request->get('per-page', 10));
      return SaleResource::collection($sales);
  }

  public function getItems()
  {
    $items = Item::where('qty', '!=', 0)->get();
    return Response::json($items, 200);
  }

  public function getSaleItem($id)
  {
    $saleitems = SaleItem::with('item')->where('sale_id','=',$id)->get();
    $data  = [];
    foreach ($saleitems as $saleitem) {
        $obj = [
          'id' => $saleitem->item->id,
          'code' => $saleitem->item->code,
          'name' => $saleitem->item->name,
          'price' => $saleitem->price,
          'cost' =>$saleitem->cost,
          'qty' => $saleitem->qty
        ];
        array_push($data,$obj);
    }
    return Response::json($data,200);
  }
}
