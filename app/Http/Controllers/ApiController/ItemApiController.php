<?php


namespace App\Http\Controllers\ApiController;


use App\Http\Controllers\Controller;
use App\Item;
use Illuminate\Http\Request;

class ItemApiController extends Controller
{
    public function getItems(Request $request)
    {
        $items = Item::where('name', 'like', '%'. $request->search . '%')
            ->orderBy('name')->paginate(10);
        return response()->json($items);
    }

    public function deleteItems(Request $request)
    {
        Item::findOrFail($request->item_id)->delete();
        return response()->json(['status' => 'success']);
    }
}
