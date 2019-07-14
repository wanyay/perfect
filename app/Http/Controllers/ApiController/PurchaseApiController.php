<?php

namespace App\Http\Controllers\ApiController;

use App\Http\Controllers\Controller;

use App\Item;

use App\PurchaseItem;

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
}
