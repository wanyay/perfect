<?php

namespace App\Http\Controllers\ApiController;

use App\Http\Controllers\Controller;

use App\Item;

use App\SaleItem;

use Response;

class SaleApiController extends Controller
{

  public function __construct()
  {

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
