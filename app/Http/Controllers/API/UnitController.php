<?php


namespace App\Http\Controllers\API;

use App\Services\UnitService;
use Illuminate\Http\Request;

class UnitController
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
}
