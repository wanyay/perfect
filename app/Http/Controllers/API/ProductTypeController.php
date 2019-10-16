<?php
namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Services\ProductTypeService;
use Illuminate\Http\Request;

class ProductTypeController extends Controller
{
    protected $productTypeService;

    public function __construct(ProductTypeService $productTypeService)
    {
        $this->productTypeService = $productTypeService;
    }

    public function search(Request $request)
    {
        $units = $this->productTypeService->search(
            $request->get('keyword'),
            $request->get('sortType'),
            $request->get('perPage'),
            $request->get('sortable')
        );

        return response()->json($units);
    }

    public function store(Request $request)
    {
        $this->validateRequest($request);

        $result = $this->productTypeService->create($request->all());

        if ($result) {
            return response()->json(['status' => 'success']);
        } else {
            return response()->json(['status' => 'error']);
        }
    }

    public function update($id, Request $request)
    {
        $this->validateRequest($request);

        $result = $this->productTypeService->update($request->all(), $id);

        if ($result) {
            return response()->json(['status' => 'success']);
        } else {
            return response()->json(['status' => 'error']);
        }
    }

    public function destroy($id)
    {
        $unit = $this->productTypeService->getById($id);
        if ($unit->delete()) {
            return response()->json(['status' => 'success']);
        }
    }

    public function validateRequest(Request $request)
    {
        return $this->validate($request, [
            'code' => "required",
            'desp' => "required"
        ]);
    }
}
