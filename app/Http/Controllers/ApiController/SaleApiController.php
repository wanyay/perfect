<?php

namespace App\Http\Controllers\ApiController;

use App\Http\Controllers\Controller;

use App\Http\Resources\ItemResource;
use App\Item;

use App\Price;
use App\SaleItem;

use Response;

class SaleApiController extends Controller
{
    public function __construct()
    {
    }

    public function getItems()
    {
        $items = Item::all()->filter(function (Item $item) {
            return $item->prices()->sum('qty') > 0 ?  true : false;
        });

        return response()->json(ItemResource::collection($items));
    }

    public function getSaleItem($id)
    {
        $saleitems = SaleItem::with('item')->where('sale_id', '=', $id)->get();
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
            array_push($data, $obj);
        }
        return Response::json($data, 200);
    }
}
