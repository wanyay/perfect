<?php


namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Services\UnitService;
use Illuminate\Http\Request;

class UnitController extends Controller
{
    protected $unitService;
    public function __construct(UnitService $unitService)
    {
        $this->unitService = $unitService;
    }

    public function search(Request $request)
    {
        $units = $this->unitService->search(
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

        $result = $this->unitService->create($request->all());

        if ($result) {
            return response()->json(['status' => 'success']);
        } else {
            return response()->json(['status' => 'error']);
        }
    }

    public function update($id, Request $request)
    {
        $this->validateRequest($request);

        $result = $this->unitService->update($request->all(), $id);

        if ($result) {
            return response()->json(['status' => 'success']);
        } else {
            return response()->json(['status' => 'error']);
        }
    }

    public function validateRequest(Request $request)
    {
        return $this->validate($request, [
            'code' => "required",
            'desp' => "required"
        ]);
    }

    public function destroy($id)
    {
        $unit = $this->unitService->getById($id);
        if ($unit->delete()) {
            return response()->json(['status' => 'success']);
        }
    }
}
