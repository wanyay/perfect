<?php


namespace App\Http\Controllers\ApiController;


use App\Http\Controllers\Controller;
use App\Item;
use Illuminate\Http\Request;

class ItemApiController extends Controller
{
    public function getItems(Request $request)
    {
        $items = Item::where('name', 'like', $request->search . '%')
            ->orderBy('name')->paginate($request->get('per-page', 10));
        return response()->json($items);
    }

    public function deleteItems(Request $request)
    {
        Item::findOrFail($request->id)->delete();
        return response()->json(['status' => 'success']);
    }
}
